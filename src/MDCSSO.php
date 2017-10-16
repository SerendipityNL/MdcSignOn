<?php

namespace DALTCORE\MdcSignOn;

use App\Models\User;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MDCSSO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->session()->has('user')) {
            Auth::login(unserialize($request->session()->get('user')));
        } else {
            return redirect()->to(config('mdc-sign-on.url').'/api/v1/oauth/auth/login/'.config('mdc-sign-on.app_token'));
        }

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('mdc-sign-on.url'),
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $response = $client->request(
            'GET',
            'api/v1/oauth/auth/get/' . auth()->user()->token . '/' . config('mdc-sign-on.app_token'),
            ['verify' => false]
        );

        $oauth = json_decode($response->getBody()->getContents());

        if (isset($oauth->code) && $oauth->code == 403) {
            return redirect()->to($oauth->login_url);
        }

        $user = User::where('token', auth()->user()->token)->first();
        $user->update(['token' => $oauth->uuid]);

        return $next($request);
    }
}
