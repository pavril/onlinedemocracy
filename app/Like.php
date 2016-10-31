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
    protected $fillable = ['like_id', 'user_id', 'comment_id', 'updated_at', 'created_at'];
    protected $primaryKey = 'like_id';
    
    public function likeId () {
    	return $this->attributes['like_id'];
    }
    
    public function userId () {
    	return $this->attributes['user_id'];
    }
    public function user () {
    	return with(new UserFactory())->getUser($this->userId());
    }

    public function commentId () {
    	return $this->attributes['comment_id'];
    }

    public function updated_at () {
    	return $this->attributes['updated_at'];
    }
    
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
