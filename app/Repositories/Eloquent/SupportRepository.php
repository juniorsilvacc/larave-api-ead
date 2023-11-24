<?php

namespace App\Repositories\Eloquent;

use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository implements SupportRepositoryInterface
{
    use RepositoryTrait;

    private $model;

    public function __construct(
        Support $model
    ) {
        $this->model = $model;
    }

    private function getSupport(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getMySupports(array $filters = [])
    {
        // Adiciona um filtro padrão para garantir que apenas os suportes do usuário autenticado sejam retornados
        $filters['user'] = true;

        // Delega a execução para o método getSupports, passando os filtros aplicados
        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
        return $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }

                // Verifica se a chave 'user' está presente no array de filtros
                if (isset($filters['user'])) {
                    // Obtém o usuário autenticado (presumivelmente utilizando algum método personalizado)
                    $user = $this->getUserAuth();

                    // Adiciona uma cláusula 'where' à consulta para filtrar por 'user_id'
                    // A consulta resultante incluirá apenas registros onde 'user_id' é igual ao ID do usuário autenticado
                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('updated_at')
            ->get();
    }

    public function createSupport(array $data)
    {
        // Obtém o usuário autenticado atualmente.
        $user = $this->getUserAuth();

        // Cria um novo suporte associado ao usuário autenticado.
        $support = $user->supports()->create([
            'description' => $data['description'],
            'lesson_id' => $data['lesson'],
            'status' => $data['status'],
        ]);

        return $support;
    }

    public function createReplyToSupportId(array $data, string $supportId)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }
}
