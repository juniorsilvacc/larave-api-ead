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
}
