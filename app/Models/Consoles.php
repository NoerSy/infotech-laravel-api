<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;



class Consoles extends Model implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'merek',
        'type',
        'isSewa',
        'image',
        'description'
    ];

    public function status()
    {
        return $this->hasOne('App\Models\SewaStatus');
    }


    public function userSewa()
    {
        return $this->hasMany('App\Models\SewaStatus');
    }

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
 
    protected $dates = [ 'deleted_at' ];
}
