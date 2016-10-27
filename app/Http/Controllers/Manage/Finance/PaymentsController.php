<?php

namespace App\Http\Controllers\Manage\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance_Account;
use App\Models\Finance_Payments;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 收支记录
 * @package App\Http\Controllers\
 */
class PaymentsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Finance_Payments::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.finance.payments.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $payments = new Finance_Payments();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $payments->Rules(), $payments->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/payments/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $payments->fill($input);
                $payments->save();
                if ($payments) {
                    return redirect('/manage/finance/payments')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $accounts = Finance_Account::all();
            $users = User::all();

            return view('manage.finance.payments.create', compact('payments', 'accounts', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $payments = Finance_Payments::find($id);
            if (!$payments) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $payments->Rules(), $payments->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/payments/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $payments->fill($input);
                $payments->save();
                if ($payments) {
                    return redirect('/manage/finance/payments')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('manage.finance.payments.edit', compact('payments'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
