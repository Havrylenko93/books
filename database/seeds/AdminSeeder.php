<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        \App\Models\User::truncate();
        DB::statement('SET foreign_key_checks=1');

        $user = new User([
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'approved_for_editing' => true,
            'role_id' => Role::where(['slug' => Role::ADMIN_SLUG])->first()->id,
        ]);
        $user->save();
    }
}
