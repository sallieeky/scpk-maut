<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departemen = ["Pengembangan Sumber Daya Mahasiswa", "Hubungan Luar", "Sosial Masyarakat", "Dalam Negeri", "Keprofesian", "Kewirausahaan", "Media dan Informasi"];
        foreach ($departemen as $dp) {
            Departemen::create([
                "nama" => $dp,
            ]);
        }
    }
}
