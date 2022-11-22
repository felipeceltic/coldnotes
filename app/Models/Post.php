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

    protected $casts = [
        // 'tags' => 'array',
        'history' => 'array'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'content',
        'restored',
        // 'tags',
        // 'imgs_url',
        // 'post_url'
    ];


    public static function generatePostUrl($title)
    {
        $url = strtolower($title);

        while(strpos($url, " ")) {
            $url = str_replace(" ", "-", $url);
        }

        return $url;
    }

    public function getPostUrl()
    {
        return url('/blog/publicacao', [ $this->user->uri, $this->post_url ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
