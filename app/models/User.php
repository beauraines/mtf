<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	public $timestamps = true;

	protected $fillable =array('email','password','name',
				  'consumer_key','consumer_secret',
				  'access_token','access_token_secret',
				  'password_confirmation','twitter_user');


        public static $rules = [
                'password' => 'required|confirmed',
                'email' => 'required|email|unique:users,email'
        ];

        public static $updaterules = [
                'password' => 'required|confirmed',
        ];

        public $errors;

        public function isValid()
        {
         $validation = Validator::make($this->attributes, static::$rules);

        if ($validation->passes()) return true;


        $this->errors = $validation->messages();
        return false;
        }

        public function isUpdateValid()
        {
         $validation = Validator::make($this->attributes, static::$updaterules);

        if ($validation->passes()) return true;


        $this->errors = $validation->messages();
        return false;
        }


}
