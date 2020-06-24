<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements JWTSubject, AuthenticatableContract
{
    use Authenticatable;
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'users';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'role_id', 'token', 'active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles(){
        return $this->hasOne('App\role', 'id', 'role_id');
    }

    public function contracts(){
        return $this->hasMany('App\contracts', 'created_by', 'id');
    }
}
