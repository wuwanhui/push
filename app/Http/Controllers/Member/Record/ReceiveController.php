<?php

namespace App\Http\Controllers\Member\Record;

use App\Http\Controllers\Controller;
use App\Http\Controllers\member\BaseController;
use App\Http\Controllers\member\memberBaseController;
use App\Http\Facades\Sms;
use App\Models\Enterprise;
use App\Models\Record_Receive;
use App\Models\Supplier_Resource;
use App\Models\Supplier_Resource_Signature;
use Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use zgldh\QiniuStorage\QiniuStorage;

/**
 * 回执记录
 * @package App\Http\Controllers\
 */
class ReceiveController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'member/record']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Record_Receive::where(function ($query) use ($key) {

            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.record.receive.index', compact('lists'));
    }

    public function update(Request $request)
    {
        try {
            Sms::getReceive();
            return Redirect::back()->withSuccess('更新成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $signature = Supplier_Resource_Signature::find($id);
            if (!$signature) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $signature->Rules(), $signature->messages());
                if ($validator->fails()) {
                    return redirect('/member/supplier/resource/signature/create/')
                        ->withInput()
                        ->withErrors($validator);
                }
                $signature->fill($input);
                $signature->save();
                if ($signature) {
                    return redirect('/member/supplier/resource/signature')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('member.supplier.resource.signature.edit', compact('signature'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $signature = Supplier_Resource_Signature::find($id);
            $signature->delete();
            return Redirect::back()->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
