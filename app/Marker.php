<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Marker extends Model implements AuthenticatableContract
{
    use Authenticatable;
    const SUCCESS = 1;
    const UNDER_DISCUSSION = 2;
    const FAILED = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'proposition_id', 'marker_id', 'marker_text', 'created_at', 'updated_at'];

    
    public function markerId () {
    	return $this->attributes['id'];
    }
    
    public function propositionId () {
    	return $this->attributes['proposition_id'];
    }
    
    public function relationMarkerId () {
    	return $this->attributes['marker_id'];
    }
    
    public function setRelationMarkerId ($value) {
    	return $this->attributes['marker_id'] = $value;
    }

    public function markerText () {
    	return $this->attributes['marker_text'];
    }
    
    public function setMarkerText ($value) {
    	return $this->attributes['marker_text'] = $value;
    }
    
    public function date_created () {
    	return $this->attributes['created_at'];
    }

    public function date_updated () {
    	return $this->attributes['updated_at'];
    }
    
}
