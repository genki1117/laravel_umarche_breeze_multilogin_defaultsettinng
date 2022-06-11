<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route; //追記

class Authenticate extends Middleware
{
    protected $user_route = 'user.login'; //追記
    protected $owner_route = 'owner.login'; //追記
    protected $admin_route = 'admin.login'; //追記
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //最初のif文でログインしてなかったら
        if (! $request->expectsJson()) {

            //追記
            //このif文でログインされてないユーザーがownerの全てのURLにアクセスしたらowner.loginにリダイレクトする
            if (Route::is('owner.*')) {
                return route($this->owner_route);
            //追記
            //このif文でログインされてないユーザーがadminの全てのURLにアクセスしたらadmin.loginにリダイレクトする
            }elseif(Route::is('admin.*')){
                return route($this->admin_route);
            } else {
            //追記
            //このif文でログインされてないユーザーがその他のURLにアクセスしたらuser.loginにリダイレクトする
                return route($this->user_route);
            }
        }
    }
}
