<?php

namespace App\Http\Controllers\Manage\Open;

use App\Http\Controllers\Controller;
use App\Http\Facades\Sms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.open.home');
    }

    public function sms(Request $request)
    {
        try {
            print_r(Input::all());
            if ($request->isMethod('post')) {
                $mobels = Input::get("mobel");
                $param = Input::get("param");
                $templateCode = Input::get("template");
                echo $mobels + $param + $templateCode;

                Sms::send($mobels, $param, $templateCode);

            } else {
                return view('sms');
            }
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }


//        $client = new TopClient;
//        //请填写自己的app key
//        $client->appkey = "23475448";
//        //请填写自己的app secret
//        $client->secretKey = "b913a8a47a1734e625eb9149f7a2dd4d";
//        $client->format = "json";
//
//        $req = new AlibabaAliqinFcSmsNumSendRequest;
//        // $req->setExtend("123456");
//        $req->setSmsType("normal");
//        $req->setSmsFreeSignName("元佑科技");
//        $req->setSmsParam("{\"code\": \"888888\", \"product\": \"元佑科技\"}");
//        //请填写需要接收的手机号码
//        $req->setRecNum("13983087661");
//        //短信模板id
//        $req->setSmsTemplateCode("SMS_10875828");
//
//        $resp = $client->execute($req);
//        print_r($resp);
//        return $resp;

    }
}
