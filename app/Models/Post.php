<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['title','description','content','image','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public static function boot(){
        parent::boot();
        //vider le cache de show si l'utilisateur modifie le post
        static::updating(function(Post $post){
            Cache::forget("post-show-{$post->id}");
        });
    }
}
