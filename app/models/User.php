<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {
    /**
     * Validation rules
     */
    public static $rules = array(
    	'username' => 'unique:users,username',
        'email' => 'required|email',
        'password' => 'required|alpha_num|between:8,16|confirmed',
    );

	public function metas(){
		return $this->hasMany('UserMeta', 'user_id');
	}

    public function profile(){
        return $this->hasOne('Profile', 'user_id');
    }
}