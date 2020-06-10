<?php
namespace App\Repo;

use App\Models\Member;
use App\Models\Role;

class MemberRepo
{
    protected $member;

    public function __construct()
    {
        $this->member = new Member;
    }

    public function register($params)
    {
        $role = Role::where('role_code', 'member')->first();

        $this->member->username = trim($params['username']);
        $this->member->password = trim($params['password']);
        $this->member->first_name = trim($params['first_name']);
        $this->member->last_name = trim($params['last_name']);
        $this->member->email = trim($params['email']);
        $this->member->role_id = intval($role->id);
        $this->member->status = 'unactive';
        $this->member->save();

        return $this->member;
    }

    /**
     * 修改帳號語言
     */
    public function setLang($params)
    {
        $this->member
            ->where('username', $params['username'])
            ->update(['lang' => $params['lang']]);
    }

    /**
     * 修改帳號幣別
     */
    public function setCurrency($params)
    {
        $this->member
            ->where('username', $params['username'])
            ->update(['currency' => $params['currency']]);
    }
}
