<?php

namespace App\Http\Controllers\Manage\Finance;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\Finance_Credit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 授信管理
 * @package App\Http\Controllers\
 */
class CreditController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $key = $request->key;
        $financeId = $request->input('financeId');

        $lists = Finance_Credit::where(function ($query) use ($key, $financeId) {
            if ($financeId) {
                $query->where('financeId', $financeId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.finance.credit.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $credit = new Finance_Credit();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $credit->Rules(), $credit->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/credit/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $credit->fill($input);
                $credit->liableId = Base::uid();
                $credit->save();
                if ($credit) {
                    return redirect('/manage/finance/credit')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('manage.finance.credit.create', compact('credit', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
