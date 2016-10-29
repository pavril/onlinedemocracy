<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Like extends Model implements AuthenticatableContract
{
    use Authenticatable;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['likeId', 'user_id', 'comment_id', 'created_at'];
    
    public function id () {
    	return $this->attributes['likeId'];
    }
    
    public function userId () {
    	return $this->attributes['userId'];
    }

    public function commentId () {
    	return $this->attributes['commentId'];
    }
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
