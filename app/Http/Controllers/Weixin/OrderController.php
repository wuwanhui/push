<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Order;
use App\Models\Produits;
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
     * 订单列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $userId = $request->input('userId');

        $lists = Order::where(function ($query) use ($key, $userId) {
            if ($userId) {
                $query->where('userId', $userId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('weixin.order.index', compact('lists'));
    }

    /**
     * 新增订单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            $order = new Order();

            $userId = 1;

            $distributionId = $request->did;
            $distribution = Distribution::find($distributionId);
            if (!$distribution) {
                return Redirect::back()->withErrors('预定失败，未找到分销商！');
            }

            $produitsId = $request->pid;
            $produits = Produits::find($produitsId);
            if (!$produits) {
                return Redirect::back()->withErrors('预定失败，价格项不存在！');
            }
            $scenic = $produits->scenic;
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $order->Rules(), $order->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/weixin/order/create')
                        ->withInput()
                        ->withErrors($validator);
                }


                $order->distributionId = $distributionId;
                $order->scenicId = $scenic->id;
                $order->produitsId = $produitsId;
                $order->userId = $userId;
                $order->name = $scenic->name;
                $order->ticketDate = $request->data;
                $order->price = $produits->fixedPrice;
                $order->quantity = $request->quantity;
                $order->total = $order->price * $order->quantity;
                $order->linkMan = $request->linkMan;
                $order->idCard = $request->idCard;
                $order->mobile = $request->mobile;
                $order->email = $request->email;
                $order->addres = $request->addres;
                $order->orderDate = time();
                $order->operationLog = time() . '进行了下单';
                $order->distributionId = $distributionId;

                $order->save();
                if ($order) {
                    return redirect('/weixin/order')->withSuccess('下单成功！');
                }
                return Redirect::back()->withErrors('下单失败！');
            }


            return view('weixin.order.create', compact('order', 'distribution', 'produits', 'scenic'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
