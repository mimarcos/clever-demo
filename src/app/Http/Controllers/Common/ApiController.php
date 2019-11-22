<?php namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;

class ApiController extends Controller {

    public function users(Request $request) {
        $users = User::all();
        return $this->respond(200, $users);
    }

}
