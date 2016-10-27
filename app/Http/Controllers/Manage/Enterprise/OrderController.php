<?php

namespace App\Http\Controllers\Manage\Member;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Member;
use App\Models\Order;
use App\Models\Produits;
use App\Models\Scenic;
use App\Models\Supplier_Resource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 订单中心
 * @package App\Http\Controllers\
 */
class OrderController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Order::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.member.order.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $order = new Order();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $order->Rules(), $order->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/member/order/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $order->fill($input);
                $order->name = "新订单";
                $order->save();
                if ($order) {
                    return redirect('/manage/member/order')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $distributions = Distribution::all();
            $members = Member::all();
            $scenics = Scenic::all();
            return view('manage.member.order.create', compact('order', 'scenics', 'distributions', 'members'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function scenic(Request $request)
    {
        $scenicId = $request->scenicId;
        $lists = Supplier_Resource::where("scenicId", $scenicId)->get();
        return json_encode($lists);
    }

}
