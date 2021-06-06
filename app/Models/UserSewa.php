<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserSewa extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    public function consoles()
    {
        return $this->hasMany('App\Models\Consoles');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sewa_at',
        'back_at',
        'is_back',
        'user_id',
        'console_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be mutated to dates.
     * scratchcode.io
     * @var array
     */

    protected $dates = ['deleted_at'];
}
