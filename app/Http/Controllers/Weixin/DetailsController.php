<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Http\Facades\Qianfan;
use App\Models\Produits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

/**
 * 产品明细
 * @package App\Http\Controllers\Weixin
 */
class DetailsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $item = Produits::find($id);
        return view('weixin.produits.details.index', compact('item'));
    }


    public function create(Request $request)
    {
        try {
            $Produits = new Produits();
            if ($request->isMethod('POST')) {
                $input = Input::all();

                $validator = Validator::make($input, $Produits->createRules(), $Produits->messages());
                if ($validator->fails()) {
                    return redirect('/supplier/resources/fleet/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $Produits->fill($input);
                $Produits->eid = Base::eid();
                $Produits->createid = Base::uid();
                $Produits->save();
                if ($Produits) {
                    return redirect('/supplier/resources/fleet/')->withSuccess('保存成功！');
                } else {
                    return Redirect::back()->withErrors('保存失败！');
                }
            }
            return view('manage.supplier.Produits.create', compact('Produits'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function sync(Request $request)
    {
        try {

            $data = Qianfan::getProduitss();
            if (isset($request->json)) {
                return Response::json($data);
            }

            $xml = simplexml_load_string($data->out); //创建 SimpleXML对象
            if ($xml->code == "OS09999") {
                foreach ($xml->content->Produitss->Produits as $item => $value) {
                    $Produits = new Produits();
                    $Produits->source = "qianfan";
                    $Produits->name = $value->prod_name;
                    $Produits->code = $value->prod_code;
                    $Produits->pringName = $value->print_name;
                    $Produits->description = $value->description;
                    $Produits->attention = $value->pay_attention;
                    $Produits->parprice = $value->parprice;
                    $Produits->payType = $value->cpgqlx;
                    $Produits->price = $value->price;
                    $Produits->beginDate = $value->begin_date;
                    $Produits->endDate = $value->end_date;
                    $Produits->save();


                }
            }

            return redirect('/manage/supplier/Produits/')->withSuccess('同步成功！');
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
