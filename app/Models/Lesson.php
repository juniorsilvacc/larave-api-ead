<?php

namespace App\Models;

use App\Models\Traits\UUIDTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    use UUIDTraits;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'description',
        'video',
    ];

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function views()
    {
        // Define uma relação "hasMany" para o modelo View
        return $this->hasMany(View::class)
            // Adiciona uma cláusula "where" à relação
            ->where(function ($query) {
                // Verifica se um usuário está autenticado
                if (auth()->check()) {
                    // Adiciona uma cláusula "where" à consulta, filtrando pelo ID do usuário autenticado
                    return $query->where('user_id', auth()->user()->id);
                }
            }
            );
    }
}
