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
      'name' => 'Serj Tankian',
      'email' => 'serj.tankian@gmail.com',
      'password' => bcrypt('123456'),
    ]);
    DB::table('users')->insert([
      'name' => 'Daron Malakian',
      'email' => 'daron.malakian@gmail.com',
      'password' => bcrypt('123456'),
    ]);
    DB::table('users')->insert([
      'name' => 'Shavo Odadjian',
      'email' => 'shavo.odadjian@gmail.com',
      'password' => bcrypt('123456'),
    ]);
    DB::table('users')->insert([
      'name' => 'John Dolmayan',
      'email' => 'john.dolmayan@gmail.com',
      'password' => bcrypt('123456'),
    ]);
  }
}
