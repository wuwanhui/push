<?php

namespace App\Http\Controllers\Manage\Supplier;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Controllers\Manage\ManageBaseController;
use App\Http\Facades\Base;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SupplierController extends BaseController
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
        $respJson = new RespJson();
        try {
            $list = Supplier::where(function ($query) use ($request) {
                if ($request->sid) {
                    $query->orWhere('supplier_id', $request->sid);
                }
                if ($request->key) {
                    $query->orWhere('name', 'like', '%' . $request->key . '%');//名称
                }
            })->orderBy('id', 'desc')->paginate($this->pageSize);
            if (isset($request->json)) {
                $respJson->setData($list);
                return response()->json($respJson);
            }

            return view('manage.supplier.index', compact('list'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }


    public function getCreate(Request $request)
    {
        $respJson = new RespJson();
        try {
            $supplier = new Supplier();
            return view('manage.supplier.create', compact('supplier'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }

    public function postCreate(Request $request)
    {
        $respJson = new RespJson();
        try {
            $supplier = new Supplier();
            $inputs = $request->all();
            $validator = Validator::make($inputs, $supplier->Rules(), $supplier->messages());
            if ($validator->fails()) {
                $respJson->setCode(2);
                $respJson->setMsg("效验失败");
                $respJson->setData($validator);
                return response()->json($respJson);
            }
            $supplier->fill($inputs);
            $supplier->manage_id = Base::manage('id');
            if ($supplier->save()) {
                $respJson->setData($supplier);
                return response()->json($respJson);
            }
            $respJson->setCode(1);
            $respJson->setMsg("新增失败");
            return response()->json($respJson);
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }


}
