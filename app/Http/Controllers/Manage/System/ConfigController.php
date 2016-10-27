<?php

namespace App\Http\Controllers\Manage\System;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Distribution;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 应用中心
 * @package App\Http\Controllers\
 */
class ConfigController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $config = Config::first();
            if (!$config) {
                $config = new Config();
            }

            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $config->Rules(), $config->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/system/config')
                        ->withInput()
                        ->withErrors($validator);
                }

                $config->fill($input);
                $config->save();
                if ($config) {
                    return redirect('/manage/system/config')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('manage.system.config.index', compact('config'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
