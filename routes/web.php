<?php

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::any('/install', 'InstallController@index');


/**
 * 管理后台
 */
Route::group(['prefix' => 'manage', 'middleware' => 'auth', 'namespace' => 'Manage'], function () {
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
        Route::any('/edit/{id}', 'RecordController@edit');
        Route::get('/delete', 'RecordController@delete');
        Route::post('/template', 'RecordController@template');


        /**
         * 信息推送
         */
        Route::group(['prefix' => 'send'], function () {
            Route::get('/', 'SendController@index');
            Route::any('/create', 'SendController@create');
            Route::any('/edit/{id}', 'SendController@edit');
            Route::get('/detail/{id}', 'SendController@detail');
            Route::get('/delete', 'SendController@delete');


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
     * 转账充值
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'FinanceController@index');
        Route::any('/create', 'FinanceController@create');
        Route::any('/edit/{id}', 'FinanceController@edit');
        Route::get('/delete', 'FinanceController@delete');
        Route::post('/template', 'FinanceController@template');


        /**
         * 账户记录
         */
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'AccountController@index');
            Route::any('/create', 'AccountController@create');
            Route::any('/edit/{id}', 'AccountController@edit');
            Route::get('/detail/{id}', 'AccountController@detail');
            Route::get('/delete', 'AccountController@delete');


        });


        /**
         * 充值记录
         */
        Route::group(['prefix' => 'recharge'], function () {
            Route::get('/', 'RechargeController@index');
            Route::any('/create', 'RechargeController@create');
            Route::any('/edit/{id}', 'RechargeController@edit');
            Route::get('/detail/{id}', 'RechargeController@detail');
            Route::get('/delete', 'RechargeController@delete');

        });
    });


});
/**
 * 会员后台
 */
Route::group(['prefix' => 'member', 'middleware' => 'auth', 'namespace' => 'Member'], function () {
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
        Route::any('/edit/{id}', 'RecordController@edit');
        Route::get('/delete', 'RecordController@delete');
        Route::post('/template', 'RecordController@template');


        /**
         * 信息推送
         */
        Route::group(['prefix' => 'send'], function () {
            Route::get('/', 'SendController@index');
            Route::any('/create', 'SendController@create');
            Route::any('/edit/{id}', 'SendController@edit');
            Route::get('/detail/{id}', 'SendController@detail');
            Route::get('/delete', 'SendController@delete');


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
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');


        /**
         * 充值记录
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
         * 充值数量记录
         */
        Route::group(['prefix' => 'quantity'], function () {
            Route::get('/', 'QuantityController@index');
            Route::any('/create', 'QuantityController@create');
            Route::any('/edit/{id}', 'QuantityController@edit');
            Route::get('/detail/{id}', 'QuantityController@detail');
            Route::get('/delete', 'QuantityController@delete');
            Route::any('/transfer', 'QuantityController@transfer');


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
