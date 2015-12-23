<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Comments extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['commentId', 'commenter_id', 'proposition_id', 'body', 'created_at', 'updated_at'];
    protected $primaryKey = 'commentId';
    
    public function commentId () {
    	return $this->attributes['commentId'];
    }
    
    public function commenterId () {
    	return $this->attributes['commenter_id'];
    }
    
    public function propositionId () {
    	return $this->attributes['proposition_id'];
    }
    
    public function body () {
    	return $this->attributes['body'];
    }
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
