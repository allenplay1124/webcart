<?php

namespace App\Repo;

use App\Models\ResetPass;
use App\Models\Member;
use Ramsey\Uuid\Uuid;

class ResetPassRepo
{
    protected $resetPass;

    protected $member;

    public function __construct()
    {
        $this->resetPass = new ResetPass;

        $this->member = new Member;
    }

    public function addResetPass(Member $member)
    {
        $uuid = Uuid::uuid4();

        $this->resetPass->role_type = $member->role->role_type;
        $this->resetPass->active_id = $member->id;
        $this->resetPass->active_code = $uuid;
        $this->resetPass->save();
        
        return site_url("member/active/{$uuid}");
    }
}
