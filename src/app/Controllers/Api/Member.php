<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Repo\MemberRepo;
use CodeIgniter\API\ResponseTrait;
use App\Validation\MemberValidator;
use App\Repo\ResetPassRepo;
use App\Repo\SystemRepo;
use App\Libraries\Email;

class Member extends BaseController
{
    use ResponseTrait;

    protected $session;

    protected $lang;

    protected $memberRepo;

    protected $resetPassRepo;

    protected $systemRepo;

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

        $this->email = new Email;

        $this->memberRepo = new MemberRepo;

        $this->resetPassRepo = new ResetPassRepo;

        $this->systemRepo = new SystemRepo;
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
        
        $activeUrl = $this->resetPassRepo->addResetPass($member);

        $site = $this->systemRepo->getSettingValue('site_name');
        
        $lang = session('lang') ?? service('request')->getLocale();

        $siteName = $site[$lang];

        $view = view('email/register', [
            'username' => $member->username,
            'activeUrl' => $activeUrl,
            'siteName' => $siteName,
        ]);
        
        $this->email->setToAddress($member->email);
        $this->email->subject(lang('Member.active_mail_title', [$siteName]));
        $this->email->body($view);
        $this->email->send();
     
        return $this->response->setJson([
            'status' => 'success',
            'status_code' => 200,
            'data' => [],
            'msg' => lang('Member.active_send_msg')
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
