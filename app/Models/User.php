<?php

namespace TMS\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use Notifiable;
	use CrudTrait;
    use HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}


    /**
     *
     * Generates username
     *
     * @param $firstName
     * @param $middleName
     * @param $lastName
     * @return string
     */
    protected function generateUsername($firstName, $middleName, $lastName){
        $expFirstName = explode(' ', $firstName);
        $firstNameInitial = "";

        foreach ($expFirstName as $key) {
            $tempFirstNameInitial = substr($key, 0, 1);
            $firstNameInitial .= $tempFirstNameInitial;
        }

        $middleNameInitial = substr($middleName, 0, 1);
        $username = strtolower($lastName) .  $firstNameInitial . $middleNameInitial;
        return strtolower($username);
    }
}
