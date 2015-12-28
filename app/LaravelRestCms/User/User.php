<?php namespace App\LaravelRestCms\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Valiadate a user's login
	 * @param  string $username 
	 * @param  string $password 
	 * @return Model           
	 */
	public function authenticate($username, $password)
	{
		return $this->where('username', $username)->where('password', $password)->get();
	}

	public function apiKey()
	{
		return $this->hasOne('App\LaravelRestCms\ApiKey\ApiKey', 'user_id');
	} 

}