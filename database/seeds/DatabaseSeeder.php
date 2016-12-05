<?php

use App\Models\Config;
use App\Models\Enterprise;
use App\Models\Manage_User;
use App\Models\Member;
use App\Models\Member_User;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //系统参数
        $config = new  Config();
        $config->name = "易讯通";
        $config->enterprise = "重庆易游通科技有限公司";
        $config->logo = "logo.jpg";
        $config->domain = "http://push.4255.cn";
        $config->assetsDomain = "http://assets.4255.cn";
        $config->tel = "023-68089477";
        $config->fax = "023-68692402";
        $config->email = "admin@4255.cn";
        $config->qq = "93894949";
        $config->addres = "重庆市九龙坡区奥体路1号";

        $config->weixinToken = "weiliwang";
        $config->weixinAppID = "wxbef7f5997ec1bc35";
        $config->wexinAppSecret = "295e036d992441a119f5976562a07347";
        $config->wexinAES = "lmQ9GJCK5CP0iMhrPCrWFZjOKYy5CgWIpVUOYn0TooR";
        $config->payMchId = "1314598001";
        $config->payNotifyUrl = "http://push.4255.cn/notice/wxpay";
        $config->payKey = "LKOP0987HYDRFS543AXCDE342WSKI87H";

        $config->save();

        $enterprise = new Enterprise();

        $enterprise->name = "重庆易游通科技有限公司";
        $enterprise->shortName = "易游通";
        $enterprise->linkMan = "吴红";
        $enterprise->mobile = "13983087661";
        $enterprise->tel = "023-68089455";
        $enterprise->fax = "023-68692402";
        $enterprise->qq = "93894949";
        $enterprise->email = "wuhong@yeah.net";
        $enterprise->password = bcrypt('wuhong');
        $enterprise->addres = "重庆市九龙坡区奥体路1号";
        $enterprise->save();

        //普通会员
        $member = new Member_User();
        $member->name = "测试会员";
        $member->email = "member@yeah.net";
        $member->password = bcrypt('wuhong');
        $enterprise->members()->save($member);

        //管理员
        $user = new  Manage_User();
        $user->name = "管理员";
        $user->email = "admin@yeah.net";
        $user->password = bcrypt('wuhong');
        $user->save();

    }
}
