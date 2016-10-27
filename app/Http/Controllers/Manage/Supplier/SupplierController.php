<?php

namespace App\Http\Controllers\Manage\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Supplier::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.supplier.index', compact('lists'));
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
