<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'role_type',
        'role_code',
        'role_name',
        'remark'
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'role_id')
            ->wherePivot('role_type', 'member');
    }
}
