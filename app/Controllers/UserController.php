<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;

class UserController extends BaseController
{
    public function __construct()
    {
        $user = auth()->user();
        if(!$user || !$user->inGroup('superadmin')){
            
        }
        $this->user = model('UserModel');
    }

    public function index()
    {
        $this->user->paginate(20);
    }
}
