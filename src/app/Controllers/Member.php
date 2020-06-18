<?php

namespace App\Controllers;

use App\Repo\MemberRepo;
use App\Repo\ResetPassRepo;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Member extends BaseController
{
    protected $memberRepo;

    protected $resetPassRepo;

    protected $session;

    public function __construct()
    {
        $this->memberRepo = new MemberRepo;

        $this->resetPassRepo = new ResetPassRepo;

        $this->session = \Config\Services::session();

    }
    public function login()
    {
        return view('web/Auth/Login');
    }

    public function register()
    {
        return view('web/Auth/Register');
    }

    public function active($active)
    {
        $active = trim($active);
        $active = esc($active);

        $resetPass = $this->resetPassRepo->getActiveMember($active);

        if (empty($resetPass)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->memberRepo->setActive($resetPass->member);

        $data = [
            'username' => $resetPass->member->username,
            'first_name' => $resetPass->member->first_name,
            'last_name' => $resetPass->member->last_name,
            'email' => $resetPass->member->email,
            'lang' => $resetPass->member->lang,
            'currency' => $resetPass->member->currency
        ];

        $this->session->set($data);
        
        $this->resetPassRepo->delResetPass($resetPass->id);

        return view('web/auth/active');
    }
}
