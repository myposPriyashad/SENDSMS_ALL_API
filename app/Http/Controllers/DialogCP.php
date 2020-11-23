<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DialogCP extends Controller
{
    public static function SendSMS(Request $request){
        $USER    = env('DC_USERID');
        $MASK   = env('DC_MASK');
        $NUM    = "94".substr($request->input(['mobile']),1);
        $MSG    = $request->input(['msg']);
        $client = new Client();
        $res = $client->request('POST',"https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination=$NUM&q=$USER&message=$MSG&Mask=$MASK",[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        return $res->getBody();
    }
}
