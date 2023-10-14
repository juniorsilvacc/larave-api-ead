<?php

namespace App\Models;

use App\Models\Traits\UUIDTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    use UUIDTraits;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'description',
        'status',
        'lesson_id',
    ];

    public $statusOptions = [
        'P' => 'Pendente, Aguardando Professor',
        'A' => 'Aguardando Aluno',
        'C' => 'Finalizado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
