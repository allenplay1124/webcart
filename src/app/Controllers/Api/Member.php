<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Repo\MemberRepo;
use CodeIgniter\API\ResponseTrait;

class Member extends BaseController
{
    use ResponseTrait;

    protected $session;

    protected $lang;

    protected $memberRepo;

    protected $request;


    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->request = \Config\Services::request();

        $this->lang = \Config\Services::language();

        $this->memberRepo = new MemberRepo;
    }

    public function setLang()
    {
        $req = $this->request->getRawInput('lang');

        $this->session->set('lang', $req['lang']);

        $username = $this->session->get('username');

        if (!empty($username)) {
            $this->memberRepo->setLang([
                'username' => $username,
                'lang' => $req['lang']
            ]);
        }

        $this->lang->setLocale($req['lang']);

        return $this->respond([
            'status' => 'ok',
            'status_code' => 200,
            'data' => lang('Comm.set_success')
        ], 200);
    }
}
