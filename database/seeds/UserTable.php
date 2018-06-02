<?php

use Illuminate\Database\Seeder;
use App\Model\Users;
class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::insert([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('111111'),
            'flag' => 1,
            'kat_user' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
