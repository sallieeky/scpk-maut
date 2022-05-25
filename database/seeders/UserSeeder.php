<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Super Admin",
            "email" => "su@itk.ac.id",
            "password" => bcrypt("admin123"),
            "role" => "super",
        ]);

        User::create([
            "nama" => "Muhammad Iqbal",
            "email" => "10191012@student.itk.ac.id",
            "password" => bcrypt("iqbal123"),
            "id_departemen" => 1,
        ]);

        User::create([
            "nama" => "Zidan Julikar",
            "email" => "10191087@student.itk.ac.id",
            "password" => bcrypt("zidan123"),
            "id_departemen" => 6,
        ]);
    }
}
