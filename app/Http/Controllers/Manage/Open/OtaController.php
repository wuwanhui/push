<?php

namespace App\Http\Controllers\Manage\Open;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Open_Ota;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 应用中心
 * @package App\Http\Controllers\
 */
class OtaController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $userId = $request->input('userId');

        $lists = Open_Ota::where(function ($query) use ($key, $userId) {
            if ($userId) {
                $query->where('userId', $userId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.open.ota.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $ota = new Open_Ota();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $ota->Rules(), $ota->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/open/ota/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $ota->fill($input);
                $ota->save();
                if ($ota) {
                    return redirect('/manage/open/ota')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $users = User::all();
            return view('manage.open.ota.create', compact('ota', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
