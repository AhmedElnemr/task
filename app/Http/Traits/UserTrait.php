<?php


namespace App\Http\Traits;


use App\Models\User;

trait UserTrait
{
    protected function checkIfUserCanLogin($user)
    {
        //user is block
        if ($user->is_blocked == 'blocked') {
            return 406;
        }
        //user in success
        $user->is_login = 'connected';
        $user->save();
        return 200;
    }

    protected function add_passport_token_to_user($user)
    {
        $token = $user->createToken('MyApp')->accessToken;
        $user = $this->getUser($user->id);
        $user->auth_token = $token;
        return $user;
    }

    protected function getUser($id){
        return User::where('id',$id)->first();
    }
}//end trait
