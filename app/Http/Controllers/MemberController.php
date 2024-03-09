<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
{
    $users = User::paginate(10);
    return view('member', compact('users'));
}

    
}
