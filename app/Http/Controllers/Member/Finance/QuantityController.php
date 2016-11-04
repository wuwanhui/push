<?php

namespace App\Http\Controllers\Member\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Models\Finance_Quantity;
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
class QuantityController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Finance_Quantity::where(function ($query) use ($key) {
            if (Base::user("type") == 2) {
                $query->whereIn('userId', Base::enterprise()->users()->pluck("id"));
            } else {
                $query->Where('userId', Base::uid());
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.finance.quantity.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $quantity = new Finance_Quantity();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $quantity->Rules(), $quantity->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/quantity/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $quantity->fill($input);
                $quantity->save();
                if ($quantity) {
                    return redirect('/member/finance/quantity')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('member.finance.quantity.create', compact('quantity'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $quantity = Finance_Quantity::find($id);
            if (!$quantity) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $quantity->Rules(), $quantity->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/quantity/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $quantity->fill($input);
                $quantity->save();
                if ($quantity) {
                    return redirect('/member/finance/quantity')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('member.finance.quantity.edit', compact('quantity'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function transfer(Request $request)
    {
        try {
            $quantity = new Finance_Quantity();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $quantity->Rules(), $quantity->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/quantity/transfer')
                        ->withInput()
                        ->withErrors($validator);
                }
                $userId = $request->userId;//转入账户
                $money = $request->money;//转账金额

                //转入用户
                $quantity->userId = $userId;
                $quantity->money = $money;
                $quantity->source = 5;
                $quantity->type = 1;
                $quantity->direction = 0;
                $quantity->liableId = Base::uid();
                $quantity->save();

                //转出用户
                $quantity = new Finance_Quantity();
                $quantity->userId = Base::uid();
                $quantity->money = $money;
                $quantity->source = 5;
                $quantity->type = 1;
                $quantity->direction = 1;
                $quantity->userId = Base::uid();
                $quantity->liableId = Base::uid();
                $quantity->save();
                if ($quantity) {
                    return redirect('/member/finance/quantity')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('member.finance.quantity.transfer', compact('quantity', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
