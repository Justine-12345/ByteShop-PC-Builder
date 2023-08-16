<?php

namespace App\Models;
use Firefly\Traits\FireflyUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,FireflyUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function reviews(){
      return $this->hasMany(Review::class, 'user_id');
    }

      public function builds(){
        return $this->hasMany(Build::class, 'user_id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'user_id');
    }

    public function message_tome(){
        return $this->hasMany(Message::class, 'to_user');
    }

    public function customer(){
        return $this->hasOne(Customer::class, 'user_id');
    }
}
