<?php

namespace App\Http\Controllers\Manage\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 用户管理
 * @package App\Http\Controllers\
 */
class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $enterpriseId = $request->enterpriseId;


        $lists = User::where(function ($query) use ($key, $enterpriseId) {
            if ($enterpriseId) {
                $query->where('enterpriseId', $enterpriseId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.enterprise.user.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $user = new User();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $user->Rules(), $user->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/user/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $user->fill($input);
                $user->password = bcrypt($request->input('password'));
                $user->enterpriseId = Base::user("enterpriseId");
                $user->save();
                if ($user) {
                    return redirect('/manage/enterprise/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            return view('manage.enterprise.user.create', compact('user', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
