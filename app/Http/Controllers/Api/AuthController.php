<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Traits\JsonOutput;

class AuthController extends Controller
{
    use JsonOutput; 

    public function register(Request $request){


        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',
            'role'=>'required',
        ]);

        
        
        $user = User::firstOrNew(['email' => $request->email ]) ;
        if ($user->exists) {
        return $this->output(false,[],'You are already registered','');
        } else {
            // user created from 'new'; does not exist in database.
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->password=bcrypt($request->password);
        $user->save();

        $token = $user->createToken('MainFreight')->accessToken;
        return $this->output(true,[],'Registered successfully',$token);
        }

    }

    

    public function login(Request $request){
        
    }
}
