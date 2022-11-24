<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use Illuminate\Foundation\Auth\User;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'content',
        'restored',
        'history',
    ];

    protected $casts = [
        'title' => 'encrypted',
        'subtitle' => 'encrypted',
        'content' => 'encrypted',
        'restored' => 'encrypted',
        'history' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
