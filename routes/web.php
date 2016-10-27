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
     * 分销渠道
     */
    Route::group(['prefix' => 'distribution', 'middleware' => 'auth', 'namespace' => 'Distribution'], function () {
        Route::get('/', 'DistributionController@index');
        Route::any('/create', 'DistributionController@create');
        Route::any('/edit/{id}', 'DistributionController@edit');
        Route::get('/delete', 'DistributionController@delete');


        /**
         * 授信管理
         */
        Route::group(['prefix' => 'sales'], function () {
            Route::get('/', 'SalesController@index');
            Route::any('/create/{id?}', 'SalesController@create');
            Route::any('/edit/{id}', 'SalesController@edit');
            Route::get('/delete', 'SalesController@delete');

        });


        /**
         * 应用管理
         */
        Route::group(['prefix' => 'apply'], function () {
            Route::get('/', 'ApplyController@index');
            Route::any('/create', 'ApplyController@create');
            Route::any('/edit/{id}', 'ApplyController@edit');
            Route::get('/delete', 'ApplyController@delete');

        });
    });

    /**
     * 会员中心
     */
    Route::group(['prefix' => 'member', 'middleware' => 'auth', 'namespace' => 'Member'], function () {
        Route::get('/', 'MemberController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 订单
         */
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index');
            Route::any('/create', 'OrderController@create');
            Route::post('/scenic', 'OrderController@scenic');


        });

    });
    /**
     * 动态营销
     */
    Route::group(['prefix' => 'marketing', 'middleware' => 'auth', 'namespace' => 'Marketing'], function () {
        Route::get('/', 'HomeController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 短信
         */
        Route::group(['prefix' => 'sms'], function () {
            Route::get('/', 'SmsController@index');
            Route::any('/create', 'SmsController@create');
            Route::any('/edit/{id}', 'SmsController@edit');
            Route::get('/delete', 'SmsController@delete');
        });

    });


    /**
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');
        Route::any('/create', 'HomeController@create');

        /**
         * 银行帐户
         */
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'AccountController@index');
            Route::any('/create', 'AccountController@create');
            Route::any('/edit/{id}', 'AccountController@edit');


        });


        /**
         * 收支记录
         */
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', 'PaymentsController@index');
            Route::any('/create', 'PaymentsController@create');
            Route::any('/edit/{id}', 'PaymentsController@edit');
        });


        /**
         * 授信管理
         */
        Route::group(['prefix' => 'credit'], function () {
            Route::get('/', 'CreditController@index');
            Route::any('/create/{id?}', 'CreditController@create');
            Route::any('/edit/{id}', 'CreditController@edit');
            Route::get('/delete', 'CreditController@delete');

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
 * 分销商
 */
Route::group(['prefix' => 'distribution', 'middleware' => 'auth', 'namespace' => 'Distribution'], function () {
    Route::get('/', 'HomeController@index');

    /**
     * 渠道供应
     */
    Route::group(['prefix' => 'supplier', 'middleware' => 'auth', 'namespace' => 'Supplier'], function () {
        Route::get('/', 'SupplierController@home');
        Route::get('/', 'SupplierController@index');
        Route::any('/create', 'SupplierController@create');
        Route::any('/edit/{id}', 'SupplierController@edit');
        Route::get('/delete', 'SupplierController@delete');


        /**
         * 原始产品管理
         */
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@index');
            Route::any('/create', 'ProductController@create');
            Route::any('/edit/{id}', 'ProductController@edit');
            Route::get('/delete', 'ProductController@delete');
            Route::get('/sync/{id}', 'ProductController@sync');
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
            Route::any('/original/{id}', 'ProduitsController@original');
            Route::any('/edit/{id}', 'ProduitsController@edit');
            Route::get('/delete', 'ProduitsController@delete');

            /**
             * 产品详情
             */
            Route::group(['prefix' => 'details'], function () {
                Route::get('/', 'DetailsController@index');
                Route::any('/create', 'DetailsController@create');
                Route::any('/edit/{id}', 'DetailsController@edit');
                Route::get('/delete', 'DetailsController@delete');
            });

            /**
             * 预定规则
             */
            Route::group(['prefix' => 'rule'], function () {
                Route::get('/', 'RuleController@index');
                Route::any('/create', 'RuleController@create');
                Route::any('/edit/{id}', 'RuleController@edit');
                Route::get('/delete', 'RuleController@delete');
            });
        });


    });


    /**
     * 分销渠道
     */
    Route::group(['prefix' => 'distribution', 'middleware' => 'auth', 'namespace' => 'Distribution'], function () {
        Route::get('/', 'DistributionController@index');
        Route::any('/create', 'DistributionController@create');
        Route::any('/edit/{id}', 'DistributionController@edit');
        Route::get('/delete', 'DistributionController@delete');


        /**
         * 授信管理
         */
        Route::group(['prefix' => 'credit'], function () {
            Route::get('/', 'CreditController@index');
            Route::any('/create/{id?}', 'CreditController@create');
            Route::any('/edit/{id}', 'CreditController@edit');
            Route::get('/delete', 'CreditController@delete');

        });
        /**
         * 授信管理
         */
        Route::group(['prefix' => 'sales'], function () {
            Route::get('/', 'SalesController@index');
            Route::any('/create/{id?}', 'SalesController@create');
            Route::any('/edit/{id}', 'SalesController@edit');
            Route::get('/delete', 'SalesController@delete');

        });


        /**
         * 应用管理
         */
        Route::group(['prefix' => 'apply'], function () {
            Route::get('/', 'ApplyController@index');
            Route::any('/create', 'ApplyController@create');
            Route::any('/edit/{id}', 'ApplyController@edit');
            Route::get('/delete', 'ApplyController@delete');

        });
    });

    /**
     * 会员中心
     */
    Route::group(['prefix' => 'member', 'middleware' => 'auth', 'namespace' => 'Member'], function () {
        Route::get('/', 'MemberController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 订单
         */
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index');
            Route::any('/create', 'OrderController@create');
            Route::post('/scenic', 'OrderController@scenic');


        });

    });
    /**
     * 动态营销
     */
    Route::group(['prefix' => 'marketing', 'middleware' => 'auth', 'namespace' => 'Marketing'], function () {
        Route::get('/', 'HomeController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 短信
         */
        Route::group(['prefix' => 'sms'], function () {
            Route::get('/', 'SmsController@index');
            Route::any('/create', 'SmsController@create');
            Route::any('/edit/{id}', 'SmsController@edit');
            Route::get('/delete', 'SmsController@delete');
        });

    });


    /**
     * 财务中心
     */
    Route::group(['prefix' => 'finance', 'middleware' => 'auth', 'namespace' => 'Finance'], function () {
        Route::get('/', 'HomeController@index');
        Route::any('/create', 'HomeController@create');

        /**
         * 银行帐户
         */
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'AccountController@index');
            Route::any('/create', 'AccountController@create');
            Route::post('/scenic', 'AccountController@scenic');


        });

        /**
         * 供应商充值记录
         */
        Route::group(['prefix' => 'recharge'], function () {
            Route::get('/', 'RechargeController@index');
            Route::any('/create', 'RechargeController@create');
            Route::post('/scenic', 'RechargeController@scenic');


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
            Route::any('/edit', 'UserController@edit');
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
