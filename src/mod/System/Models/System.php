<?php

namespace Mod\System\Models;

use Illuminate\Database\Eloquent\Model;


class System extends Model
{
    protected $table = 'systems';

    public $incrementing = false;

    protected $primaryKey = ['module_code', 'setting_key'];

    protected $fillable = [
        'module_code',
        'setting_key',
        'setting_value',
        'remark',
        'created_user',
        'updated_user'
    ];
}