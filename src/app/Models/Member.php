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
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
}
