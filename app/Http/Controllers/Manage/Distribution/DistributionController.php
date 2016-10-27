<?php

namespace App\Http\Controllers\Manage\Distribution;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Distribution;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 产品列表
 * @package App\Http\Controllers\
 */
class DistributionController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Distribution::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);
        
        return view('manage.distribution.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $distribution = new Distribution();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $distribution->Rules(), $distribution->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/distribution/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $distribution->fill($input);
                $distribution->save();
                if ($distribution) {
                    return redirect('/manage/distribution')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $users = User::all();

            return view('manage.distribution.create', compact('distribution', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
