<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     'refferal',
    //     'name',
    //     'email',
    //     'phone',
    //     'username',
    //     'password',
    //     'password_text',
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'address' => 'object',
        'ver_code_send_at' => 'datetime',

    ];

        // SCOPES

        public function getFullNameAttribute()
        {
            return $this->name . ' ' . $this->last_name;
        }

        public function scopeActive()
        {
            return $this->where('status', 1);
        }

        public function scopeBanned()
        {
            return $this->where('status', 0);
        }

        public function scopeEmailUnverified()
        {
            return $this->where('email_verify', 0);
        }

        public function scopeSmsUnverified()
        {
            return $this->where('sms_verify', 0);
        }

        public function login_logs()
        {
            return $this->hasMany(UserLogin::class);
        }

        public function withdrawals()
        {
            return $this->hasMany(Withdrawal::class)->where('status','!=',0);
        }

        public function deposits()
        {
            return $this->hasMany(Deposit::class)->where('status','!=',0);
        }

        public function transactions()
        {
            return $this->hasMany(Trx::class);
        }

        public function parent()
        {
            return $this->belongsTo(User::class, 'refferal');
        }

        public function children()
        {
            return $this->hasMany(User::class, 'refferal');
        }
}
