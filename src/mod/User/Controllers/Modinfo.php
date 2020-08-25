<?php

namespace Mod\User\Controllers;

use App\Controllers\BaseController;
use Illuminate\Database\Capsule\Manager as DB;
use Mod\System\Models\Module;

class Modinfo extends BaseController
{
    private $modConfig;

    public function __construct()
    {
        $this->modConfig = new \Mod\User\Config\Modinfo;
    }

    public function install()
    {
        if (Module::where('module_code', 'User')->exists()) {
            return $this->response->setStatusCode(406)
                ->setJSON([
                    'error_msg' => lang('modules.install_fail')
                ]);
        }

        $prefix = env('database.default.DBPrefix');
        //帳號管理
        DB::schema()->create('users', function ($table) {
            $table->bigIncrements('id');
            $table->string('username')->unique()->comment('會員帳號');
            $table->string('password')->comment('會員密碼');
            $table->string('email')->comment('電子郵件');
            $table->enum('status', ['unactive', 'active', 'stop'])
                ->default('unactive')
                ->index()
                ->comment('狀態：unactive未啟用, active啟用, stop停權');
            $table->string('created_user')->comment('建立者帳號');
            $table->string('updated_user')->comment('修改者帳號');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE {$prefix}users COMMENT '會員帳號'");
        //角色
        DB::schema()->create('roles', function ($table) {
            $table->increments('id');
            $table->string('role_code')->unique()->null()->comment('角色代碼');
            $table->jsonb('role_name')->null()->comment('角色名稱');
            $table->boolean('is_active')->index()->default(true)->comment('是否啟用');
            $table->string('remark')->null()->comment('備註');
            $table->string('created_user')->comment('建立者帳號');
            $table->string('updated_user')->comment('修改者帳號');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE {$prefix}roles COMMENT '角色'");
        //帳號角色
        DB::schema()->create('user_role', function ($table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index()->default(0)->comment('會員ID');
            $table->Integer('role_id')->index()->default(0)->comment('角色ID');
        });
        DB::statement("ALTER TABLE {$prefix}user_role COMMENT '帳號角色'");
        //權限
        DB::schema()->create('permissions', function ($table) {
            $table->increments('id');
            $table->string('module_code')->index()->comment('模組代碼');
            $table->string('permission_code')->unique()->comment('權限代碼');
            $table->jsonb('permission_name')->comment('權限名稱');
            $table->jsonb('action')->comment('權限動作');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE {$prefix}permissions COMMENT '權限'");
        //角色權限
        DB::schema()->create('role_permission', function ($table) {
            $table->increments('id');
            $table->Integer('role_id')->index()->default(0)->comment('角色ID');
            $table->Integer('permission_id')->index()->default(0)->comment('權限ID');
            $table->Integer('acl_value')->default(0)->comment('權限值');
        });
        DB::statement("ALTER TABLE {$prefix}role_permission COMMENT '權限'");

        //安裝模組
        Module::create([
            'module_code' => 'User',
            'module_name' => $this->modConfig->modName,
            'version' => $this->modConfig->modVersion,
            'cover_img' => $this->modConfig->coverImg,
            'description' => $this->modConfig->modDesc,
        ]);

        return $this->response->setStatusCode(200)
            ->setJSON([
                'msg' => lang('modules.install_success')
            ]);
    }

    public function update()
    {
        return $this->response->setStatusCode(200)
            ->setJSON([
                'msg' => lang('modules.update_success')
            ]);
    }

    public function uninstall()
    {
        DB::schema()->dropIfExists('users');
        DB::schema()->dropIfExists('roles');
        DB::schema()->dropIfExists('user_role');
        DB::schema()->dropIfExists('permissions');
        DB::schema()->dropIfExists('role_permission');

        Module::where('module_code', 'User')->delete();

        return $this->response->setSTatusCode(200)
            ->setJSON([
                'msg' => lang('modules.uninstall_success')
            ]);
    }
}
