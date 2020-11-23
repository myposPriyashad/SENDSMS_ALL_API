<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\Self_;

class DialogToken extends Controller
{
    public static function GenerateToken(){
        $tokenPara = json_encode(
            array(
                "u_name"    => env('DT_USERNAME'),
                "passwd"    => env('DT_PASSWORD')
            ));
        $client = new Client();
        $res = $client->request('POST','https://digitalreachapi.dialog.lk/refresh_token.php',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body'=> $tokenPara
        ]);
        return $res->getBody();
    }

    public function SendSMS(Request $request){
        $port = env('DT_MASK');
        $channel = env('DT_CHANNEL');
        $call_back = env('DT_CALL_BACK');
        $token = json_decode(self::GenerateToken())->access_token;
        $mobile = "94".substr($request->input(['mobile']),1);
        $msg = $request->input(['msg']);
        $sdate = date('Y-m-d H:i:s');
        $edate = date('Y-m-d H:i:s',time()+24*60*60);
        $smsPara = json_encode(
            array(
                "msisdn"        => $mobile,
                "channel"       => $channel,
                "mt_port"       => $port,
                "s_time"        => $sdate,
                "e_time"        => $edate,
                "msg"           => $msg,
                "callback_url"  => $call_back
            ));

        $client = new Client();
        $res = $client->request('POST','https://digitalreachapi.dialog.lk/camp_req.php',[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $token
            ],
            'body'=> $smsPara
        ]);
        //echo $res->getStatusCode();
        //echo $res->getBody();
        //var_dump($res->getHeader('content-type'));
        return $res->getBody();
    }
}
