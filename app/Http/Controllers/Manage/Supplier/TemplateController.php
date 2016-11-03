<?php

namespace App\Http\Controllers\Manage\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Enterprise;
use App\Models\Supplier_Resource;
use App\Models\Supplier_Resource_Template;
use Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use zgldh\QiniuStorage\QiniuStorage;

/**
 * 模板配置
 * @package App\Http\Controllers\
 */
class TemplateController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Supplier_Resource_Template::where(function ($query) use ($key) {

            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.supplier.template.index', compact('lists'));
    }

    public function create($id, Request $request)
    {
        try {
            $template = new Supplier_Resource_Template();
            $resource = Supplier_Resource::find($id);
            if (!$resource) {
                return Redirect::back()->withErrors('资源不存在！');
            }


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $template->Rules(), $template->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/template/create/')
                        ->withInput()
                        ->withErrors($validator);
                }


                $template->fill($input);
                $template->resourceId = $id;
                $template->save();
                if ($template) {
                    return redirect('/manage/supplier/resource/detail/' . $id . '?tab=template')->withSuccess('保存成功！');
                }

                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            $template->resource = $resource;
            $template->resourceId = $id;
            return view('manage.supplier.resource.template.create', compact('template', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $template = Supplier_Resource_Template::find($id);
            if (!$template) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $template->Rules(), $template->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/template/create/' . $template->resourceId)
                        ->withInput()
                        ->withErrors($validator);
                }
                $template->fill($input);
                $template->save();
                if ($template) {
                    return redirect('/manage/supplier/resource/detail/' . $template->resourceId . '?tab=template')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            return view('manage.supplier.resource.template.edit', compact('template', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $template = Supplier_Resource_Template::find($id);
            $template->delete();
            return redirect('/manage/supplier/resource/detail/' . $template->resourceId . '?tab=template')->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
