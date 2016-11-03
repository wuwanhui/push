<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Enterprise;
use App\Models\Record_Resource;
use App\Models\Record;
use Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use zgldh\QiniuStorage\QiniuStorage;

/**
 * 信息推送
 * @package App\Http\Controllers\
 */
class SendController extends BaseController
{
 
    public function index(Request $request)
    {
        try {
            $signature = new Record();


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $signature->Rules(), $signature->messages());
                if ($validator->fails()) {
                    return redirect('/manage/record/signature/create/')
                        ->withInput()
                        ->withErrors($validator);
                }


                $signature->fill($input);
                $signature->save();
                if ($signature) {
                    return redirect('/manage/record/detail')->withSuccess('保存成功！');
                }


                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            $signature->resource = $resource;
            $signature->resourceId = $id;
            return view('manage.record.resource.create', compact('signature', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $signature = Record::find($id);
            if (!$signature) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $signature->Rules(), $signature->messages());
                if ($validator->fails()) {
                    return redirect('/manage/record/signature/create/')
                        ->withInput()
                        ->withErrors($validator);
                }
                $signature->fill($input);
                $signature->save();
                if ($signature) {
                    return redirect('/manage/record/signature')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('manage.record.resource.edit', compact('signature'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $signature = Record::find($id);
            $signature->delete();
            return Redirect::back()->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
