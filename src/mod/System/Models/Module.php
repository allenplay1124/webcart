<?php

namespace Mod\System\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'module_code',
        'module_name',
        'version',
        'cover_img',
        'description',
        'created_user',
        'updated_user'
    ];
}