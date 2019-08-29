<?php

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
           'name'=>'admin',
           'email'=>'admin@huntingfederation.com',
           'password'=>bcrypt('adminHuntingFederation')
        ]);
    }
}
