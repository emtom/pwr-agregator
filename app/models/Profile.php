<?php


class Profile extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function profileType() {
    	return $this->hasOne('Profile_type', 'type_id');
    }
}

