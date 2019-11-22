<?php namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class PageController extends Controller {

    public function home() {
        $users = User::all();
        return view('home', ['users' => $users]);
    }

}
