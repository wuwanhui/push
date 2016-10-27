<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
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
class ReceiveController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Supplier_Resource_Signature::where(function ($query) use ($key) {

            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.supplier.signature.index', compact('lists'));
    }

    public function create($id, Request $request)
    {
        try {
            $signature = new Supplier_Resource_Signature();
            $resource = Supplier_Resource::find($id);
            if (!$resource) {
                return redirect('/manage/supplier/resource/detail/' . $id)->withSuccess('资源不存在！');
            }


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $signature->Rules(), $signature->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/signature/create/')
                        ->withInput()
                        ->withErrors($validator);
                }


                $signature->fill($input);
                $signature->resourceId = $id;
                $signature->save();
                if ($signature) {
                    return redirect('/manage/supplier/resource/detail/' . $id)->withSuccess('保存成功！');
                }


                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            $signature->resource = $resource;
            $signature->resourceId = $id;
            return view('manage.supplier.resource.signature.create', compact('signature', 'enterprises'));

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
                    return redirect('/manage/supplier/resource/signature/create/')
                        ->withInput()
                        ->withErrors($validator);
                }
                $signature->fill($input);
                $signature->save();
                if ($signature) {
                    return redirect('/manage/supplier/resource/signature')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('manage.supplier.resource.signature.edit', compact('signature'));

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
