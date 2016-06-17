<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Tags extends Model implements AuthenticatableContract
{
    use Authenticatable;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'content', 'created_at'];
    
    public function id () {
    	return $this->attributes['id'];
    }
    
    public function content () {
    	return $this->attributes['content'];
    }
    
    public function setContent ($content) {
    	return $this->attributes['content'] = $content;
    }
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
