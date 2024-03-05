<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function adminPosts()
    {
        $posts = Posts::paginate(5);
        return view('admin.posts', compact('posts'));
    }

    public function welcome()
{
    $posts = Posts::paginate(5);
    $users = User::all();
    return view('welcome', compact('posts', 'users'));


}

}
