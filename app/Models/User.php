<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'family',
        'username',
        'password',
        'user_type',
        'expire_date',
        'membershipID',
        'pic'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullname()
    {
        return $this->name . ' ' . $this->family;
    }

    public function getStatus()
    {
        if ($this->status == null)
            return 'فعال';
        return $this->status;
    }

    public function getUserType()
    {
        if ($this->user_type == 0)
            return 'کاربر';
        return 'ادمین';
    }

    public function getCreatedAt()
    {
        return verta($this->created_at);
    }
    public function getExpireDate()
    {
        return verta($this->expire_date)->formatDate();
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'user_id');
    }
}
