<?php

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
        //管理员
        $user = new \App\Models\User();
        $user->name = "吴红";
        $user->email = "wuhong@yeah.net";
        $user->password = bcrypt('wuhong');
        $user->save();
    }
}
