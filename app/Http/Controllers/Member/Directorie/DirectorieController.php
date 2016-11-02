<?php

namespace App\Http\Controllers\Member\Directorie;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\Directorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Qiniu\Auth;

/**
 * 通讯录管理
 * @package App\Http\Controllers\
 */
class DirectorieController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Directorie::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.directorie.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $directorie = new Directorie();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $directorie->Rules(), $directorie->messages());
                if ($validator->fails()) {
                    return redirect('/member/directorie/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $directorie->fill($input);
                $directorie->userId = Base::uid();
                $directorie->save();
                if ($directorie) {
                    return redirect('/member/directorie')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('member.directorie.create', compact('directorie'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $directorie = Directorie::find($id);
            if (!$directorie) {
                return redirect('/member/directorie')->withSuccess('数据不存在！');
            }
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $directorie->Rules(), $directorie->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/directorie/edit')
                        ->withInput()
                        ->withErrors($validator);
                }

                $directorie->fill($input);
                $directorie->userId = Base::uid();
                $directorie->save();
                if ($directorie) {
                    return redirect('/member/directorie')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('member.directorie.edit', compact('directorie'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}