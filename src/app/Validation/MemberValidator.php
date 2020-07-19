<?php

namespace App\Validation;

class MemberValidator
{
    protected $validate;

    public function __construct($validate)
    {
        $this->validate = $validate;
    }

    public function register($data)
    {
        $this->validate->setRules([
            'first_name' => [
                'label' => lang('Member.first_name'),
                'rules' => 'required|string'
            ],
            'last_name' => [
                'label' => lang('Member.last_name'),
                'rules' => 'required|string'
            ],
            'username' => [
                'label' => lang('Member.username'),
                'rules' => 'required|string|is_unique[members.username]'
            ],
            'email' => [
                'label' => lang('Member.email'),
                'rules' => 'required|valid_email|is_unique[members.email]'
            ],
            'password' => [
                'label' => lang('Member.password'),
                'rules' => 'required|string|min_length[6]'
            ],
            'confirm_password' => [
                'label' => lang('Member.confirm_password'),
                'rules' => 'required|matches[password]'
            ]
        ]);

        $this->validate->run($data);

        return $this->validate;
    }

    public function login($data)
    {
        $this->validate->setRules([
            'username' => [
                'label' => lang('Member.username'),
                'rules' => 'required|string'
            ],
            'password' => [
                'label' => lang('Member.password'),
                'rules' => 'required|string'
            ]
        ]);
    }
}
