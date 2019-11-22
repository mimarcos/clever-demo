<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class TestTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();

        $users = [ 
            'mimarcos' => 'Michael Marcos',
            'jberry' => 'John Berry',
            'aordover' => 'Andrew Ordover'
        ];
        // create the test user

        foreach ($users as $username => $name) {
            User::create([
                'username' => $username,
                'email' => "$username@$username.com",
                'password' => Hash::make($username),
                'name' => $name
            ]);
        }
    }

}
