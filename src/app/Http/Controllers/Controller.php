<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function respond($code, $data) {
        return response()->json($data, $code);
    }

    protected function error($code, $message) {
        return response()->json(['message' => $message], $code);
    }

    protected function bail($e) {
        $code = 500;
        if($e->getCode() >= 400 && $e->getCode() <= 599) {
            $code = $e->getCode();
        }

        return response()->json(['message' => $e->getMessage()], $code);
    }


    protected function props_only($data) {
        $ret = [];

        foreach($data as $k => $v) {
            if(!is_array($v)) {
                $ret[$k] = $v;
            }
        }

        return $ret;
    }
}
