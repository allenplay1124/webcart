<?php
namespace App\Repo;

use App\Models\Member;

class MemberRepo
{
    protected $member;

    public function __construct()
    {
        $this->member = new Member;
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
