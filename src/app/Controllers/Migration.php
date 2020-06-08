<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use \CodeIgniter\Exceptions\PageNotFoundException as NotFound;

class Migration extends BaseController
{
    protected $session;
    protected $request;
    protected $lang;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->lang = \Config\Services::language();
        $this->lang->setLocale('zh-TW');
        helper('filesystem');
        helper('cookie');
    }

    /**
     * 列表
     */
    public function index()
    {
        if ($this->session->get('migration_username') !== 'sysAdmin') {
            return redirect()->to('/migration/login');
        }
        
        $data = [
            'username' => $this->session->get('migration_username'),
            'seeds' => directory_map(__DIR__ . '/../Database/Seeds/'),
        ];
        
        return view('web/Migration/Index', $data);
    }

    /**
     * 登入頁面
     */
    public function login()
    {
        return view('web/Migration/Login');
    }
}
