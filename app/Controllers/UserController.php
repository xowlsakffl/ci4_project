<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->user = model('UserModel');
    }

    public function index()
    {
        $this->user->paginate(20);
        echo "1";
    }
}
