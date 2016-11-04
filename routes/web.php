<?php

use Illuminate\Support\Facades\Artisan;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Auth::routes();

Route::get('/', 'HomeController@index');

Route::any('/install', 'InstallController@index');


/**
 * 管理后台
 */
Route::group(['prefix' => 'manage', 'middleware' => ['auth', 'can:manage,App\Models\User'], 'namespace' => 'Manage'], function () {
    Route::get('/', 'HomeController@index');


    /**
     * 企业管理
     */
    Route::group(['prefix' => 'enterprise', 'middleware' => 'auth', 'namespace' => 'Enterprise'], function () {
        Route::get('/', 'EnterpriseController@index');
        Route::any('/create', 'EnterpriseController@create');
        Route::any('/edit/{id}', 'EnterpriseController@edit');
        Route::get('/delete', 'EnterpriseController@delete');

        /**
         * 企业用户
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::any('/create', 'UserController@create');
            Route::any('/edit/{id}', 'UserController@edit');
            Route::get('/delete', 'UserController@delete');

        });
    });


    /**
     * 供应商
     */
    Route::group(['prefix' => 'supplier', 'middleware' => 'auth', 'namespace' => 'Supplier'], function () {
        Route::get('/', 'SupplierController@index');
        Route::any('/create', 'SupplierController@create');
        Route::any('/edit/{id}', 'SupplierController@edit');
        Route::get('/delete', 'SupplierController@delete');


        /**
         * 资源管理
         */
        Route::group(['prefix' => 'resource'], function () {
            Route::get('/', 'ResourceController@index');
            Route::any('/create', 'ResourceController@create');
            Route::any('/edit/{id}', 'ResourceController@edit');
            Route::get('/detail/{id}', 'ResourceController@detail');
            Route::get('/delete', 'ResourceController@delete');

            /**
             * 签名
             */
            Route::group(['prefix' => 'signature'], function () {
                Route::get('/', 'SignatureController@index');
                Route::any('/create/{id}', 'SignatureController@create');
                Route::any('/edit/{id}', 'SignatureController@edit');
                Route::get('/detail/{id}', 'SignatureController@detail');
                Route::get('/delete/{id}', 'SignatureController@delete');


            });
            /**
             * 模板
             */
            Route::group(['prefix' => 'template'], function () {
                Route::get('/', 'TemplateController@index');
                Route::any('/create/{id}', 'TemplateController@create');
                Route::any('/edit/{id}', 'TemplateController@edit');
                Route::get('/detail/{id}', 'TemplateController@detail');
                Route::get('/delete/{id}', 'TemplateController@delete');


            });
        });


    });

    /**
     * 发送记录
     */
    Route::group(['prefix' => 'record', 'middleware' => 'auth', 'namespace' => 'Record'], function () {
        Route::get('/', 'RecordController@index');
        Route::any('/create', 'RecordController@create');
        Route::any('/create/{id}', 'RecordController@createByid');
        Route::any('/edit/{id}', 'RecordController@edit');
        Route::get('/delete', 'RecordController@delete');
        Route::post('/template', 'RecordController@template');


        /**
         * 发送模板
         */
        Route::group(['prefix' => 'template'], function () {
            Route::get('/', 'TemplateController@index');
            Route::any('/create', 'TemplateController@create');
            Route::any('/edit/{id}', 'TemplateController@edit');
            Route::get('/delete/{id}', 'TemplateController@delete');


        });


        /**
         * 回执报告
         */
        Route::group(['prefix' => 'receive'], function () {
            Route::get('/', 'ReceiveController@index');
            Route::any('/create', 'ReceiveController@create');
            Route::any('/edit/{id}', 'ReceiveController@edit');
            Route::get('/detail/{id}', 'ReceiveController@detail');
            Route::get('/delete', 'ReceiveController@delete');

        });
    });

    /**
     * 通讯录
     */
    Route::group(['prefix' => 'directorie', 'middleware' => 'auth', 'namespace' => 'Directorie'], function () {
        Route::get('/', 'DirectorieController@index');
        Route::any('/create', 'DirectorieController@create');
        Route::any('/edit/{id}', 'DirectorieController@edit');
        Route::get('/delete', 'DirectorieController@delete');
        Route::get('/detail/{id}', 'DirectorieController@detail');


    });


    /**
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');


        /**
         * 支付记录
         */
        Route::group(['prefix' => 'recharge'], function () {
            Route::get('/', 'RechargeController@index');
            Route::any('/create', 'RechargeController@create');
            Route::any('/transfer', 'RechargeController@transfer');
            Route::any('/edit/{id}', 'RechargeController@edit');
            Route::get('/detail/{id}', 'RechargeController@detail');
            Route::get('/delete', 'RechargeController@delete');

        });


        /**
         * 充值记录
         */
        Route::group(['prefix' => 'quantity'], function () {
            Route::get('/', 'QuantityController@index');
            Route::any('/create', 'QuantityController@create');
            Route::any('/edit/{id}', 'QuantityController@edit');
            Route::get('/detail/{id}', 'QuantityController@detail');
            Route::get('/delete', 'QuantityController@delete');
            Route::any('/transfer', 'QuantityController@transfer');


        });

        /**
         * 发票申请
         */
        Route::group(['prefix' => 'invoice'], function () {
            Route::get('/', 'InvoiceController@index');
            Route::any('/create', 'InvoiceController@create');
            Route::any('/edit/{id}', 'InvoiceController@edit');
            Route::get('/detail/{id}', 'InvoiceController@detail');
            Route::get('/delete', 'InvoiceController@delete');


        });

        /**
         * 发票申请
         */
        Route::group(['prefix' => 'pay'], function () {
            Route::get('/', 'WeixinPayController@index');
            Route::any('/create', 'WeixinPayController@create');
            Route::any('/edit/{id}', 'WeixinPayController@edit');
            Route::get('/detail/{id}', 'WeixinPayController@detail');
            Route::get('/delete', 'WeixinPayController@delete');


        });
    });

    /**
     * 系统配置
     */
    Route::group(['prefix' => 'system', 'middleware' => 'auth', 'namespace' => 'System'], function () {
        Route::get('/', 'HomeController@index');


        /**
         * 参数设置
         */
        Route::group(['prefix' => 'config'], function () {
            Route::any('/', 'ConfigController@index');
            Route::any('/create', 'ConfigController@create');
            Route::any('/transfer', 'ConfigController@transfer');
            Route::any('/edit/{id}', 'ConfigController@edit');
            Route::get('/detail/{id}', 'ConfigController@detail');
            Route::get('/delete', 'ConfigController@delete');

        });


    });

});
/**
 * 会员后台
 */
Route::group(['prefix' => 'member', 'middleware' => ['auth', 'can:member,App\Models\User'], 'namespace' => 'Member'], function () {
    Route::get('/', 'HomeController@index');


    /**
     * 企业管理
     */
    Route::group(['prefix' => 'enterprise', 'middleware' => 'auth', 'namespace' => 'Enterprise'], function () {
        Route::get('/', 'EnterpriseController@index');
        Route::any('/create', 'EnterpriseController@create');
        Route::any('/edit/{id}', 'EnterpriseController@edit');
        Route::get('/delete', 'EnterpriseController@delete');

        /**
         * 企业用户
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::any('/create', 'UserController@create');
            Route::any('/edit/{id}', 'UserController@edit');
            Route::get('/delete/{id}', 'UserController@delete');

        });
    });


    /**
     * 供应商
     */
    Route::group(['prefix' => 'supplier', 'middleware' => 'auth', 'namespace' => 'Supplier'], function () {
        Route::get('/', 'SupplierController@index');
        Route::any('/create', 'SupplierController@create');
        Route::any('/edit/{id}', 'SupplierController@edit');
        Route::get('/delete', 'SupplierController@delete');


        /**
         * 资源管理
         */
        Route::group(['prefix' => 'resource'], function () {
            Route::get('/', 'ResourceController@index');
            Route::any('/create', 'ResourceController@create');
            Route::any('/edit/{id}', 'ResourceController@edit');
            Route::get('/detail/{id}', 'ResourceController@detail');
            Route::get('/delete', 'ResourceController@delete');

            /**
             * 签名
             */
            Route::group(['prefix' => 'signature'], function () {
                Route::get('/', 'SignatureController@index');
                Route::any('/create/{id}', 'SignatureController@create');
                Route::any('/edit/{id}', 'SignatureController@edit');
                Route::get('/detail/{id}', 'SignatureController@detail');
                Route::get('/delete/{id}', 'SignatureController@delete');


            });
            /**
             * 模板
             */
            Route::group(['prefix' => 'template'], function () {
                Route::get('/', 'TemplateController@index');
                Route::any('/create/{id}', 'TemplateController@create');
                Route::any('/edit/{id}', 'TemplateController@edit');
                Route::get('/detail/{id}', 'TemplateController@detail');
                Route::get('/delete/{id}', 'TemplateController@delete');


            });
        });


    });

    /**
     * 发送记录
     */
    Route::group(['prefix' => 'record', 'middleware' => 'auth', 'namespace' => 'Record'], function () {
        Route::get('/', 'RecordController@index');
        Route::any('/create', 'RecordController@create');
        Route::any('/create/{id}', 'RecordController@createByid');
        Route::any('/edit/{id}', 'RecordController@edit');
        Route::get('/delete', 'RecordController@delete');
        Route::post('/template', 'RecordController@template');


        /**
         * 发送模板
         */
        Route::group(['prefix' => 'template'], function () {
            Route::get('/', 'TemplateController@index');
            Route::any('/create', 'TemplateController@create');
            Route::any('/edit/{id}', 'TemplateController@edit');
            Route::get('/delete/{id}', 'TemplateController@delete');


        });


        /**
         * 回执报告
         */
        Route::group(['prefix' => 'receive'], function () {
            Route::get('/', 'ReceiveController@index');
            Route::any('/create', 'ReceiveController@create');
            Route::any('/edit/{id}', 'ReceiveController@edit');
            Route::get('/detail/{id}', 'ReceiveController@detail');
            Route::get('/delete', 'ReceiveController@delete');

        });


    });
    /**
     * 通讯录
     */
    Route::group(['prefix' => 'directorie', 'middleware' => 'auth', 'namespace' => 'Directorie'], function () {
        Route::get('/', 'DirectorieController@index');
        Route::any('/create', 'DirectorieController@create');
        Route::any('/edit/{id}', 'DirectorieController@edit');
        Route::get('/delete', 'DirectorieController@delete');
        Route::get('/detail/{id}', 'DirectorieController@detail');


    });


    /**
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');


        /**
         * 支付记录
         */
        Route::group(['prefix' => 'recharge'], function () {
            Route::get('/', 'RechargeController@index');
            Route::any('/create', 'RechargeController@create');
            Route::any('/transfer', 'RechargeController@transfer');
            Route::any('/edit/{id}', 'RechargeController@edit');
            Route::get('/detail/{id}', 'RechargeController@detail');
            Route::get('/delete', 'RechargeController@delete');

        });


        /**
         * 充值记录
         */
        Route::group(['prefix' => 'quantity'], function () {
            Route::get('/', 'QuantityController@index');
            Route::any('/create', 'QuantityController@create');
            Route::any('/edit/{id}', 'QuantityController@edit');
            Route::get('/detail/{id}', 'QuantityController@detail');
            Route::get('/delete', 'QuantityController@delete');
            Route::any('/transfer', 'QuantityController@transfer');


        });

        /**
         * 发票申请
         */
        Route::group(['prefix' => 'invoice'], function () {
            Route::get('/', 'InvoiceController@index');
            Route::any('/create', 'InvoiceController@create');
            Route::any('/edit/{id}', 'InvoiceController@edit');
            Route::get('/detail/{id}', 'InvoiceController@detail');
            Route::get('/delete', 'InvoiceController@delete');


        });


    });

    /**
     * 开放平台
     */
    Route::group(['prefix' => 'open', 'middleware' => 'auth', 'namespace' => 'Open'], function () {

        Route::get('/', 'HomeController@index');

        /**
         * 应用管理
         */
        Route::group(['prefix' => 'apply'], function () {
            Route::get('/', 'ApplyController@index');
            Route::any('/create', 'ApplyController@create');
            Route::any('/edit/{id}', 'ApplyController@edit');
            Route::get('/delete/{id}', 'ApplyController@delete');
        });

    });

    /**
     * 系统配置
     */
    Route::group(['prefix' => 'system', 'middleware' => 'auth', 'namespace' => 'System'], function () {

        Route::get('/', 'HomeController@index');
        /**
         * 系统参数
         */
        Route::group(['prefix' => 'config'], function () {
            Route::any('/', 'ConfigController@index');
        });

        /**
         * 用户管理
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::any('/create', 'UserController@create');
            Route::post('/scenic', 'UserController@scenic');
        });


        /**
         * 基础数据
         */
        Route::group(['prefix' => 'base'], function () {
            Route::get('/', 'BaseDataController@index');
            Route::any('/create', 'BaseDataController@create');
            Route::post('/scenic', 'BaseDataController@scenic');
        });

    });

});


/**
 * 微信
 */
Route::group(['prefix' => 'weixin', 'namespace' => 'Weixin'], function () {
    Route::get('/', 'HomeController@index');


    /**
     * 会员中心
     */
    Route::group(['prefix' => 'member', 'middleware' => 'auth'], function () {
        Route::get('/', 'MemberController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 订单
         */
        Route::group(['prefix' => 'pay', 'middleware' => 'auth'], function () {
            Route::get('/', 'PayController@index');
            Route::any('/create', 'PayController@create');
        });
    });


    /**
     * 订单管理
     */
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index');
        Route::any('/create', 'OrderController@create');
    });

    /**
     * 景区资料
     */
    Route::group(['prefix' => 'scenic'], function () {
        Route::get('/', 'ScenicController@index');
        Route::any('/create', 'ScenicController@create');
        Route::any('/edit/{id}', 'ScenicController@edit');
        Route::get('/delete', 'ScenicController@delete');
    });


    /**
     * 产品中心
     */
    Route::group(['prefix' => 'produits'], function () {
        Route::get('/', 'ProduitsController@index');

        Route::any('/create', 'ProduitsController@create');
        /**
         * 产品详情
         */
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', 'DetailsController@index');

            Route::any('/create', 'DetailsController@create');

        });
    });

});
