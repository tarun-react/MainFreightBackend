<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait JsonOutput
{
    public function output($status,$data,$msg,$token)
    {
        return response()->json(['status'=>$status,'message'=>$msg,'data'=>$data,'token' => $token], 200);
    }
}