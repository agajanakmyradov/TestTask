<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function last() {
        echo now()->format('Y-m-d');
    }
}
