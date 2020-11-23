<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Etisalat extends Controller
{
    public static function SendSMS(Request $request){
        $USER    = env('E_USERNAME');
        $PWD    = env('E_PASSWORD');
        $MASK   = env('E_MASK');
        $NUM    = "94".substr($request->input(['mobile']),1);
        $MSG    = $request->input(['msg']);
        $client = new Client();
        $res = $client->request('POST',"http://bulksms.hutch.lk/sendsmsmultimask2.php?USER=$USER&PWD=$PWD&MASK=$MASK&MSG=$MSG&NUM=$NUM",[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        return $res->getBody();
    }
}
