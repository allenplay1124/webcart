<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Validation\MigrationValidator;

class Migration extends BaseController
{
    use ResponseTrait;

    protected $session;
    protected $request;
    protected $validate;
    protected $lang;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validate = \Config\Services::validation();
        $this->lang = \Config\Services::language();
        $this->lang->setLocale('zh-TW');
    }

    /**
     * 執行登入
     */
    public function setLogin()
    {
        $input = $this->request->getPost();

        $validate = new MigrationValidator($this->validate);
        $validate = $validate->doLogin($input);

        if ($validate->getErrors()) {
            $error['errors'] =  $validate->getErrors();
            return $this->response
                ->setJson([
                    'status' => 'error',
                    'status_code' => 400,
                    'data' => $error,
                    csrf_token() => csrf_hash(),
                ]);
        }
        $this->session->remove('migration_username');
        $this->session->set(['migration_username' => 'sysAdmin']);

        return $this->response->setJson([
            'status' => 'ok',
            'status_code' => 200,
            'data' => '登入成功',
            csrf_token() => csrf_hash(),
        ]);
    }

    /**
     * 執行 migration
     */
    public function setMigration()
    {
        if ($this->session->get('migration_username') !== 'sysAdmin') {
            return $this->response->setJson([
                'status' => 'error',
                'status_code' => 403,
                'data' => '沒有執行權限',
                csrf_token() => csrf_hash(),
            ]);
        }

        $migrate = \Config\Services::migrations();
        $isSuccess = $migrate->latest();

        if ($isSuccess) {
            return $this->response->setJson([
                'status' => 'ok',
                'status_code' => 200,
                'data' => '執行成功',
                csrf_token() => csrf_hash(),
            ]);
        }

        return $this->response->setJson([
            'status' => 'error',
            'status_code' => 500,
            'data' => '執行失敗',
            csrf_token() => csrf_hash(),
        ]);
    }

    /**
     * 執行 Seeder
     */
    public function setSeeder()
    {
        if ($this->session->get('migration_username') !== 'sysAdmin') {
            return $this->response->setJson([
                'status' => 'error',
                'status_code' => 403,
                'data' => '沒有執行權限',
                csrf_token() => csrf_hash(),
            ]);
        }

        $seed = \Config\Database::seeder();
        $value = $this->request->getPost('seed');
        if (empty($value)) {
            return $this->response->setJson([
                'status' => 'error',
                'status_code' => 403,
                'data' => '參數錯誤',
                csrf_token() => csrf_hash(),
            ]);
        }

        $seed->call($value);

        return $this->response->setJson([
            'status' => 'ok',
            'status_code' => 200,
            'data' => '執行成功',
            csrf_token() => csrf_hash(),
        ]);
    }

    public function setLogout()
    {
        if (!$this->request->isAJAX()) {
            throw NotFound::forPageNotFound();
        }
        $this->session->remove('migration_username');
        $this->session->destroy();

        return $this->response->setJson([
            'status' => 'ok',
            'status_code' => 200,
            'data' => '登出成功',
            csrf_token() => csrf_hash(),
        ]);
    }
}
