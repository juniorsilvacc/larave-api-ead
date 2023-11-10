<?php

namespace App\Models;

use App\Models\Traits\UUIDTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;
    use UUIDTraits;

    public $incrementing = false;

    protected $table = 'reply_supports';

    protected $keyType = 'uuid';

    protected $fillable = [
        'description',
        'support_id',
        'user_id',
    ];

    protected $touches = ['support'];

    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
