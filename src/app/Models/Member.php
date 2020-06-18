<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $table = 'members';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'username',
        'password',
        'email',
        'role_id',
        'status',
        'lang',
        'currency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function resetPass()
    {
        return $this->hasOne('App\Models\ResetPass', 'active_id')
            ->wherePivot('role_type', 'member');
    }

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
}
