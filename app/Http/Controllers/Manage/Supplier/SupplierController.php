<?php

namespace App\Http\Controllers\Manage\Supplier;

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
        $list = Supplier::where(function ($query) use ($request) {
            if ($request->sid) {
                $query->orWhere('supplier_id', $request->sid);
            }
            if ($request->key) {
                $query->orWhere('name', 'like', '%' . $request->key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.supplier.index', compact('list'));
    }


    public function create(Request $request)
    {

        try {
            $supplier = new Supplier();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $supplier->Rules(), $supplier->messages());
                if ($validator->fails()) {
                    return redirect('/supplier/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $supplier->fill($input);
                $supplier->userId = Base::manage()->id;
                $supplier->save();
                if ($supplier) {
                    return redirect('/manage/supplier')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('manage.supplier.create', compact('supplier'));
        } catch (Exception $ex) {
            echo '异常！' . $ex->getMessage();
            // return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
