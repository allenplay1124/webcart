<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Repo\MemberRepo;
use CodeIgniter\API\ResponseTrait;
use App\Validation\MemberValidator;
use App\Repo\ResetPassRepo;

class Member extends BaseController
{
    use ResponseTrait;

    protected $session;

    protected $lang;

    protected $memberRepo;

    protected $resetPassRepo;

    protected $request;

    protected $validate;

    protected $email;

    protected $view;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->request = \Config\Services::request();

        $this->lang = \Config\Services::language();

        $this->validate = \Config\Services::validation();

        $this->email = \Config\Services::email();

        $this->memberRepo = new MemberRepo;

        $this->resetPassRepo = new ResetPassRepo;
    }

    public function register()
    {
        $input = $this->request->getPost();

        $validate = new MemberValidator($this->validate);

        $validate = $validate->register($input);

        if ($validate->getErrors()) {
            $error['errors'] =  $validate->getErrors();
            return $this->response->setStatusCode(400)->setJson([
                'status' => 'error',
                'status_code' => 400,
                'data' => $error,
                'msg' => implode("<BR />", $error['errors']),
                csrf_token() => csrf_hash(),
            ]);
        }

        $member = $this->memberRepo->register($input);

        if (empty($member)) {
            return $this->response->setStatusCode(500)->setJson([
                'status' => 'error',
                'status_code' => 500,
                'data' => [],
                'msg' => '創建失敗'
            ]);
        }
        
        $active_url = $this->resetPassRepo->addResetPass($member);


        $view = view('email/register', [
            'username' => $member->username,
            'active_url' => $active_url
        ]);
        $this->email->setMailType('html');
        $this->email->setTo($member->email);
        $this->email->setSubject('帳號啟用信');
        $this->email->setMessage($view);
        $this->email->send();

        var_dump($this->email->printDebugger());
        
        return $this->response->setJson([
            'status' => 'success',
            'status_code' => 200,
            'data' => [],
            'msg' => '認證信可寄出，請前住啟用帳號'
        ]);
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

        return $this->response->setJson([
            'status' => 'ok',
            'status_code' => 200,
            'data' => lang('Comm.set_success')
        ]);
    }
}
