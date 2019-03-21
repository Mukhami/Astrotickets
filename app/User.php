<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'password','token',
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
     * Returns true if user is verified
     * @return bool
     */
    public function verified()
    {
        return $this->token === null;
    }


    /**
     * Send User Verification Email
     * @return void
     */

    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function paypalpayment()
    {
        return $this->hasMany(PaypalPayment::class, 'user_id');
    }
}
