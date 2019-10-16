<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\Address;

class UsersTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = User::create([
        		'firstname' => 'super',
        		'lastname' => 'admin ',
                'middlename' => 'middlename',
                'username' => 'super-admin',
                'mobile' => $faker->phoneNumber,
                'status' => 1,
        		'email' => 'admin@iitcebu.net',
        		'password' => Hash::make('23456789')
        	]);
        $newUser = User::find($user->id);
        $user->roles()->attach($user->id, [
                'user_id' => $user->id,
                'role_id' => 1
            ]);
       $user = User::create([
                'firstname' => 'user',
                'lastname' => 'user',
                'middlename' => 'user',
                'username' => 'user',
                'mobile' => $faker->phoneNumber,
                'email' => 'user@iitcebu.net',
                'password' => Hash::make('23456789'),
                'status' => 1
            ]);
        $newUser = User::find($user->id);
        $newUser->roles()->attach($user->id, [
                'user_id' => $user->id,
                'role_id' => 2
            ]);
       
    }
}
