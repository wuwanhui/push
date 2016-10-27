<?php

namespace App\Http\Controllers\Manage\Marketing;

use App\Http\Controllers\Controller;
use App\Http\Facades\Sms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage/sms/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                $mobiles = $request->input("mobile");
                $param = $request->input("param");
                $templateCode = $request->input("template");
                $sign = $request->input("sign");

                $resp = Sms::send($mobiles, $param, $templateCode, $sign);
                //成功返回
                if (property_exists($resp, 'result')) {
                    return redirect('manage/sms/create/')->withSuccess('发送成功！');
                }
                //失败返回
                if (property_exists($resp, 'code')) {
                    return Redirect::back()->withErrors('发送失败！' . $resp->sub_msg);
                }
            }
            return view('manage/sms/create');


        } catch (Exception $ex) {
            echo $ex->getMessage();
            // return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storasdfsdfe(Request $request)
    {
        try {
            //  print_r(Input::all());
            $mobels = $request->input("mobel");
            $param = $request->input("param");
            $templateCode = $request->input("template");
            echo $mobels + $param + $templateCode;

            Sms::send($mobels, $param, $templateCode);

            return redirect('/manage/sms/create/')->withSuccess('发送成功！');
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
