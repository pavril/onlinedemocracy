<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Flags extends Model implements AuthenticatableContract
{
    use Authenticatable;
    
    const TYPE_1 = "offensive";
    const TYPE_2 = "inappropriate";
    const TYPE_3 = "incomprehensible";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'flags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'type', 'proposition', 'created_at'];
    
    public function id () {
    	return $this->attributes['id'];
    }
    
    public function type () {
    	if ($this->attributes['type'] == 1) {
    		return Flags::TYPE_1;
    	} elseif ($this->attributes['type'] == 2) {
    		return Flags::TYPE_2;
    	} else {
    		return Flags::TYPE_3;
    	}
    }
    
    public function propositionId () {
    	return $this->attributes['proposition'];
    }
    
    public function created_at () {
    	return $this->attributes['created_at'];
    }
    
}
