<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = Role::whereName('admin')->first();
        $sellerRole = Role::whereName('seller')->first();

        //
         User::create([
            'id'                             => 91455996,
            'first_name'                     => 'Mohsen',
            'last_name'                      => '',
            'username'                       => 'moh872',
            'password'                       => Hash::make('1234'),
            'token'                          => Str::random(64),
            'role_id'                        => $adminRole->id,
            'activated'                      => false,
        ]);
         //
        User::create([
            'id'                             => 110699273,
            'first_name'                     => 'Mohammad Ali ',
            'last_name'                      => 'Joneidi',
            'username'                       => 'moh586',
            'password'                       => Hash::make('1234'),
            'token'                          => Str::random(64),
            'role_id'                        => $adminRole->id,
            'activated'                      => true,
        ]);
    }
}
