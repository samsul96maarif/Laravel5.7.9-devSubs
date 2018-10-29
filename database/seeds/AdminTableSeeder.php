<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'admin',
          'username' => 'admin',
          'role' => '1',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('secret'),
      ]);
    }
}
