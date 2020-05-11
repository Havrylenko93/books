<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Role::truncate();
        DB::statement("SET foreign_key_checks=1");

        $roles = [
            [
                'name' => 'Admin',
                'slug' => Role::ADMIN_SLUG
            ],
            [
                'name' => 'User',
                'slug' => Role::USER_SLUG
            ],
        ];

        Role::insert($roles);
    }
}
