<?php

namespace App\Validation;

use CodeIgniter\HTTP\RequestInterface;

class MigrationValidator
{
    protected $validate;
    
    public function __construct($validate)
    {
        $this->validate = $validate;
    }

    public function doLogin($data)
    {
        $this->validate->setRules([
            'password' => [
                'label' => '密碼',
                'rules' => 'required|migrationPassword'
            ]
        ]);
        $this->validate->run($data);

        return $this->validate;
    }

   
}
