<?php

namespace App\Http\Controllers\Manage\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Controllers\Manage\ManageBaseController;
use App\Http\Facades\Qianfan;
use App\Models\Supplier_Resource;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class  ResourceController extends ManageBaseController
{

    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'manage/supplier']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $supplierId = $request->supplierId;
        $scenicId = $request->scenicId;
        $lists = Supplier_Resource::where(function ($query) use ($key, $supplierId, $scenicId) {
            if ($supplierId) {
                $query->where('supplierId', $supplierId);
            }
            if ($scenicId) {
                $query->where('scenicId', $scenicId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//商品名称
                $query->orWhere('attention', 'like', '%' . $key . '%');//注意事项
                $query->orWhere('parprice', $key);//票面价
                $query->orWhere('price', $key);//成本价格
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.supplier.resource.index', compact('lists'));
    }


    public function create(Request $request)
    {
        try {
            $resource = new Supplier_Resource();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $resource->Rules(), $resource->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $resource->fill($input);
                $resource->save();
                if ($resource) {
                    return redirect('/manage/supplier/resource')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $suppliers = Supplier::all();
            return view('manage.supplier.resource.create', compact('resource', 'suppliers'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }


    public function edit($id, Request $request)
    {
        try {

            $resource = Supplier_Resource::find($id);
            if (!$resource) {
                return Redirect::back()->withErrors('数据加载失败！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $resource->Rules(), $resource->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $resource->fill($input);
                $resource->save();
                if ($resource) {
                    return redirect('/manage/supplier/resource')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $suppliers = Supplier::all();
            return view('manage.supplier.resource.edit', compact('resource', 'suppliers'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function detail($id, Request $request)
    {
        try {

            $resource = Supplier_Resource::find($id);
            if (!$resource) {
                return redirect('/manage/supplier/resource')->withErrors('数据加载失败！');
            }

            return view('manage.supplier.resource.detail', compact('resource'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $resource = new Supplier_Resource();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $resource->Rules(), $resource->messages());
                if ($validator->fails()) {
                    return redirect('/manage/supplier/resource/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $resource->fill($input);
                $resource->save();
                if ($resource) {
                    return redirect('/manage/supplier/resource')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            $supplier = Supplier::all();
            $scenic = Scenic::all();
            return view('manage.supplier.resource.create', compact('resource', 'supplier', 'scenic'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function sync($id, Request $request)
    {
        try {
            $supplier = Supplier::find($id);
            if ($supplier == null) {
                return Redirect::back()->withErrors('供应商不存在！');
            }
            $data = null;
            switch ($supplier->platform) {
                case "have"://自有平台
                    break;
                case "qianfan"://千番分销
                    $data = Qianfan::getResources();
                    $xml = simplexml_load_string($data->out); //创建 SimpleXML对象

                    if ($xml->code == "OS09999") {

                        foreach ($xml->content->products->product as $item => $value) {

                            $resource = new Supplier_Resource();
                            $resource->supplierId = $id;
                            $resource->name = $value->prod_name;
                            $resource->code = $value->prod_code;
                            $resource->description = $value->description;
                            $resource->attention = $value->pay_attention;
                            $resource->price = $value->price;//成本价格
                            $resource->parprice = $value->parprice;//票面价
                            $resource->fixedPrice = $value->parprice;//票面价

                            $resource->payType = $value->cpgqlx == 2 ? 0 : 1;
                            $resource->beginDate = $value->begin_date;
                            $resource->endDate = $value->end_date;

                            $resource->save();
                        }
                    }
                    break;
            }
            if (isset($request->json)) {
                return Response::json($data);
            }
            return redirect('/manage/supplier/resource/' . $id)->withSuccess('同步成功！');
        } catch (Exception $ex) {

            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }


    public function supplier(Request $request)
    {
        $lists = Supplier::all();
        return json_encode($lists);
    }

    public function scenic(Request $request)
    {
        $lists = Scenic::all();
        return json_encode($lists);
    }


}
