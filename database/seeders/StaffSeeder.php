<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jml_dep = Departemen::count();
        $kat = ["Sangat Baik", "Baik", "Cukup", "Kurang", "Sangat Kurang"];
        for ($i = 1; $i <= 50; $i++) {
            $dep = rand(1, $jml_dep);
            $keaktifan = $kat[rand(0, 4)];
            $tepat_waktu = $kat[rand(0, 4)];
            $kontribusi = $kat[rand(0, 4)];
            $sikap = $kat[rand(0, 4)];
            $data = [
                "nama" => "User " . $i,
                "nim" => 101910 . $i,
                "id_departemen" => $dep,
                "keaktifan" => $keaktifan,
                "tepat_waktu" => $tepat_waktu,
                "kontribusi" => $kontribusi,
                "sikap" => $sikap,
            ];
            Staff::create($data);
        }
    }
}
