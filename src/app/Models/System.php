<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'setting_key',
        'setting_value',
        'remark',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'setting_key' => 'string',
        'setting_value' => 'array'
    ];
}
