<?php

namespace App\Http\Controllers\Member\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\Finance_Quantity;
use App\Models\Finance_Invoice;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Qiniu\Auth;

/**
 * 发票申请
 * @package App\Http\Controllers\
 */
class InvoiceController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Finance_Invoice::where(function ($query) use ($key) {
            $query->whereIn('userId', Base::enterprise()->users()->pluck("id"));
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('member.finance.invoice.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $invoice = new Finance_Invoice();


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $invoice->Rules(), $invoice->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/invoice/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $invoice->fill($input);
                $invoice->userId = Base::uid();
                $invoice->save();

                if ($invoice) {
                    return redirect('/member/finance/invoice')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $invoice->money = Base::user("invoiceMoney");
            $invoice->enterprise = Base::enterprise("name");
            $invoice->linkMan = Base::enterprise("linkMan");
            $invoice->mobile = Base::enterprise("mobile");
            $invoice->tel = Base::enterprise("tel");
            $invoice->addres = Base::enterprise("addres");

            return view('member.finance.invoice.create', compact('invoice'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $invoice = Finance_Invoice::find($id);
            if (!$invoice) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $invoice->Rules(), $invoice->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/invoice/edit')
                        ->withInput()
                        ->withErrors($validator);
                }

                $invoice->fill($input);
                $invoice->userId = Base::uid();
                $invoice->liableId = Base::uid();
                $invoice->save();

                if ($invoice->state == 0) {

                    $quantity = new Finance_Quantity();

                    $quantity->userId = $invoice->userId;
                    $quantity->quantity = $invoice->money * 10;
                    $quantity->direction = 0;
                    $quantity->liableId = Base::uid();
                    $quantity->expiryDate = date('Y-m-d H:i:s', strtotime("+1 year"));
                    $quantity->invoiceId = $invoice->id;
                    $quantity->state = 0;
                    $quantity->save();

                }
                if ($invoice) {
                    return redirect('/member/finance/invoice')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('member.finance.invoice.edit', compact('invoice', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function transfer(Request $request)
    {
        try {
            $invoice = new Finance_Invoice();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $invoice->Rules(), $invoice->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/finance/invoice/transfer')
                        ->withInput()
                        ->withErrors($validator);
                }
                $userId = $request->userId;//转入账户
                $money = $request->money;//转账金额

                //转入用户
                $invoice->userId = $userId;
                $invoice->money = $money;
                $invoice->source = 5;
                $invoice->type = 1;
                $invoice->direction = 0;
                $invoice->liableId = Base::uid();
                $invoice->save();

                //转出用户
                $invoice = new Finance_Invoice();
                $invoice->userId = Base::uid();
                $invoice->money = $money;
                $invoice->source = 5;
                $invoice->type = 1;
                $invoice->direction = 1;
                $invoice->userId = Base::uid();
                $invoice->liableId = Base::uid();
                $invoice->save();
                if ($invoice) {
                    return redirect('/member/finance/invoice')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('member.finance.invoice.transfer', compact('invoice', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
