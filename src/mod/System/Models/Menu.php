<?php

namespace Mod\System\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'group',
        'parent_id',
        'title',
        'route',
        'target',
        'sort',
        'is_show',
    ];

    public $casts = [
        'title' => 'array',
        'sort' => 'integer',
        'is_show' => 'boolean'
    ];

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
