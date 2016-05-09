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
    // $this->call(UserTableSeeder::class);
    DB::table('users')->insert([
      'name' => 'Daron Malakian',
      'email' => 'daron.malakian@gmail.com',
      'password' => bcrypt('secret'),
    ]);
  }
}
