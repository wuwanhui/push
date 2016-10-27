<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 发送记录
 * @package App\Http\Controllers\Manage\Record
 */
class RecordController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Record::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.record.index', compact('lists'));
    }


    public function create(Request $request)
    {

        try {
            $record = new Record();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $record->Rules(), $record->messages());
                if ($validator->fails()) {
                    return redirect('/record/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $record->fill($input);
                $record->save();
                if ($record) {
                    return redirect('/manage/record')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('manage.record.create', compact('record'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
