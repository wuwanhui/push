<?php

use App\Models\Enterprise;
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
        $enterprise = new Enterprise();

        $enterprise->name = "重庆易游通科技有限公司";
        $enterprise->shortName = "易游通";
        $enterprise->linkMan = "吴红";
        $enterprise->mobile = "13983087661";
        $enterprise->tel = "023-68089455";
        $enterprise->fax = "023-68692402";
        $enterprise->qq = "93894949";
        $enterprise->email = "wuhong@yeah.net";
        $enterprise->addres = "重庆市九龙坡区奥体路1号";
        $enterprise->save();

        //管理员
        $user = new  User();
        $user->name = "吴红";
        $user->email = "wuhong@yeah.net";
        $user->password = bcrypt('wuhong');
        $enterprise->users()->save($user);

    }
}
