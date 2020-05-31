<?php
namespace App\Validation;

class Myrules
{
    public function migrationPassword(string $str, string &$error =  null)
    {
        if ($str != getEnv('migration.password')) {
            $error = lang('Migrations.passwordError', ['field' => '密碼']);
            return false;
        }
        return true;
    }
}
