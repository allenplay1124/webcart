<?php
namespace App\Repo;

use App\Models\System;

class SystemRepo
{
    protected $system;

    public function __construct()
    {
        $this->system = new System;
    }

    public function getSettingValue(string $key)
    {
        return $this->system->where('setting_key', $key)->first()->setting_value;
    }
}
