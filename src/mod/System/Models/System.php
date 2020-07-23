<?php

namespace Mod\System\Models;

use Illuminate\Database\Eloquent\Model;


class System extends Model
{
    protected $table = 'systems';

    protected $fillable = [
        'module_code',
        'setting_key',
        'setting_value',
        'remark'
    ];
}