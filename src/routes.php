<?php

use GuzzleHttp\Client;

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
    Route::get('mdc/callback/{uuid}', function ($uuid) {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('oauth.url'),
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'api/v1/oauth/auth/get/' . $uuid . '/' . config('oauth.app_token') , ['verify' => false]);

        $userInfo = json_decode($response->getBody()->getContents());

        if(isset($userInfo->error) && $userInfo->code == 403)
        {
            return redirect()->to($userInfo->login_url);
        }

        $user = \App\Models\User::firstOrCreate([
            'name' => $userInfo->user->firstname.' '.$userInfo->user->lastname,
            'email' => $userInfo->user->email,
        ]);

        $user->token = $userInfo->uuid;
        $user->save();

        \Session::put('user', serialize($user));
        \Session::save();

        return redirect()->to('/');

    })->middleware(['session']);
});