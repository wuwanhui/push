<?php

namespace App\Http\Controllers\Member\Distribution;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Models\Distribution;
use App\Models\Produits;
use App\Models\ReserveRule;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


/**
 * 预定规则
 * @package App\Http\Controllers\
 */
class RuleController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $produitsid = $request->input('produitsid');
        $lists = ReserveRule::where(function ($query) use ($key, $produitsid) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
            if ($produitsid) {
                $query->orWhere('produitsid', $produitsid);
            }

        })->orderBy('id', 'desc')->paginate($this->pageSize);
        return view('member.distribution.produits.rule.index', compact('lists'));
    }

    public
    function create(Request $request)
    {
        try {
            $rule = new ReserveRule();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $rule->Rules(), $rule->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/distribution/produits/rule/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $rule->fill($input);
                $rule->save();
                if ($rule) {
                    return redirect('/member/distribution/produits/rule')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $produits = Produits::all();

            return view('member.distribution.produits.rule.create', compact('rule', 'produits'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
