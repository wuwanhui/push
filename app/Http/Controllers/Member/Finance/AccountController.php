<?php

namespace App\Http\Controllers\Member\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance_Account;
use App\Models\Distribution;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 财务帐户
 * @package App\Http\Controllers\
 */
class AccountController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Finance_Account::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.finance.account.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $account = new Finance_Account();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $account->Rules(), $account->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/account/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $account->fill($input);
                $account->save();
                if ($account) {
                    return redirect('/member/finance/account')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('member.finance.account.create', compact('account'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $account = Finance_Account::find($id);
            if (!$account) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $account->Rules(), $account->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/account/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $account->fill($input);
                $account->save();
                if ($account) {
                    return redirect('/member/finance/account')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('member.finance.account.edit', compact('account'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
