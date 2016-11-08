<?php

namespace App\Http\Controllers\Manage\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Controllers\Manage\ManageBaseController;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\Finance_Quantity;
use App\Models\Finance_Recharge;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 支付记录
 * @package App\Http\Controllers\
 */
class RechargeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'manage/finance']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $key = $request->key;

        $lists = Finance_Recharge::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.finance.recharge.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $recharge = new Finance_Recharge();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $recharge->Rules(), $recharge->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/recharge/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $recharge->fill($input);
                $recharge->userId = Base::manage("id");
                $recharge->save();

                if ($recharge) {
                    return redirect('/manage/finance/recharge')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $members = Member::where("type", 2)->get();

            return view('manage.finance.recharge.create', compact('recharge', 'members'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $recharge = Finance_Recharge::find($id);
            if (!$recharge) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $recharge->Rules(), $recharge->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/recharge/edit')
                        ->withInput()
                        ->withErrors($validator);
                }

                $recharge->fill($input);
                $recharge->userId = Base::manage("id");
                $recharge->save();

                if ($recharge->state == 0) {

                    $quantity = new Finance_Quantity();

                    $quantity->memberId = $recharge->memberId;
                    $quantity->quantity = $recharge->money * 10;
                    $quantity->direction = 0;
                    $quantity->userId = Base::manage("id");
                    $quantity->expiryDate = date('Y-m-d H:i:s', strtotime("+1 year"));
                    $quantity->rechargeId = $recharge->id;
                    $quantity->state = 0;
                    $quantity->save();

                }
                if ($recharge) {
                    return redirect('/manage/finance/recharge')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('manage.finance.recharge.edit', compact('recharge', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function transfer(Request $request)
    {
        try {
            $recharge = new Finance_Recharge();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $recharge->Rules(), $recharge->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/finance/recharge/transfer')
                        ->withInput()
                        ->withErrors($validator);
                }
                $userId = $request->userId;//转入账户
                $money = $request->money;//转账金额

                //转入用户
                $recharge->userId = $userId;
                $recharge->money = $money;
                $recharge->source = 5;
                $recharge->type = 1;
                $recharge->direction = 0;
                $recharge->liableId = Base::member("id");
                $recharge->save();

                //转出用户
                $recharge = new Finance_Recharge();
                $recharge->userId = Base::member("id");
                $recharge->money = $money;
                $recharge->source = 5;
                $recharge->type = 1;
                $recharge->direction = 1;
                $recharge->userId = Base::member("id");
                $recharge->liableId = Base::member("id");
                $recharge->save();
                if ($recharge) {
                    return redirect('/manage/finance/recharge')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('manage.finance.recharge.transfer', compact('recharge', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
