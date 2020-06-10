<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPass extends Model
{
    protected $table = 'reset_pass';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'role_type',
        'active_id',
        'active_code',
    ];
}
