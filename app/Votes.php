<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Votes extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'vote_value', 'proposition_id', 'vote_user', 'vote_school_email', 'created_at'];
    
    public function voteId () {
    	return $this->attributes['id'];
    }
    
    public function voteValue () {
    	return $this->attributes['vote_value'];
    }
    
    public function propositionId () {
    	return $this->attributes['proposition_id'];
    }
    
    public function voteUser () {
    	return $this->attributes['vote_user'];
    }
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
