<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function maut()
    {
        $kriteria = [
            "k1" => [
                "p1" => 1,
                "p2" => 2,
                "p3" => 3,
                "p4" => 4,
                "p5" => 5,
            ],
            "k2" => [
                "p1" => 1,
                "p2" => 2,
                "p3" => 3,
                "p4" => 4,
            ],
            "k3" => [
                "p1" => 1,
                "p2" => 2,
                "p3" => 3,
                "p4" => 4,
            ],
            "k4" => [
                "p1" => 1,
                "p2" => 2,
                "p3" => 3,
                "p4" => 4,
                "p5" => 5,
            ],
        ];

        $bobot_kriteria = [
            "k1" => 40,
            "k2" => 30,
            "k3" => 20,
            "k4" => 10,
        ];


        $data = [
            [
                "nama" => "User1",
                "k1" => "p1",
                "k2" => "p4",
                "k3" => "p2",
                "k4" => "p1",
            ],
            [
                "nama" => "User2",
                "k1" => "p2",
                "k2" => "p3",
                "k3" => "p1",
                "k4" => "p4",
            ],
            [
                "nama" => "User3",
                "k1" => "p3",
                "k2" => "p1",
                "k3" => "p2",
                "k4" => "p5",
            ],
            [
                "nama" => "User4",
                "k1" => "p4",
                "k2" => "p1",
                "k3" => "p3",
                "k4" => "p2",
            ],
            [
                "nama" => "User5",
                "k1" => "p5",
                "k2" => "p4",
                "k3" => "p3",
                "k4" => "p1",
            ],
            [
                "nama" => "User6",
                "k1" => "p2",
                "k2" => "p3",
                "k3" => "p4",
                "k4" => "p5",
            ],
        ];

        $pembobotan = [];
        for ($i = 0; $i < count($data); $i++) {
            $temp = [];
            $max_min = [];
            foreach ($kriteria as $key => $value) {
                $ktemp = $data[$i][$key];
                $count_konf = $kriteria[$key][$ktemp] / count($kriteria[$key]);
                $temp[$key] = $count_konf;
            }
            $pembobotan[$i] = $temp;
        }
        // return $pembobotan;

        $max_min = [];
        foreach ($pembobotan as $pb) {
            foreach ($pb as $key => $value) {
                if (!isset($max_min[$key])) {
                    $max_min[$key] = [
                        "max" => $value,
                        "min" => $value,
                    ];
                } else {
                    if ($value > $max_min[$key]["max"]) {
                        $max_min[$key]["max"] = $value;
                    }
                    if ($value < $max_min[$key]["min"]) {
                        $max_min[$key]["min"] = $value;
                    }
                }
            }
        }
        // return $max_min;

        $konfigurasi = [];
        foreach ($pembobotan as $pb) {
            $temp = [];
            foreach ($pb as $key => $value) {
                $temp[$key] = ($value - $max_min[$key]["min"]) / ($max_min[$key]["max"] - $max_min[$key]["min"]);
            }
            $konfigurasi[] = $temp;
        }
        // return $konfigurasi;

        $nilai = [];
        foreach ($konfigurasi as $key => $value) {
            $temp = [];
            $jumlah = 0;
            foreach ($value as $key2 => $value2) {
                $temp[$key2] = $value2 * $bobot_kriteria[$key2];
                $jumlah += $temp[$key2];
            }
            // $temp["jumlah"] = $jumlah;
            // $nilai[$key] = $temp;
            $nilai[] = $jumlah;
        }
        // return $nilai;

        $result = [];
        for ($i = 0; $i < count($data); $i++) {
            $result[$i] = $data[$i];
            $result[$i]["nilai"] = $nilai[$i];
        }
        return $result;
    }

    public function rankMaut()
    {
        $data = $this->maut();
        usort($data, function ($a, $b) {
            return $a['nilai'] < $b['nilai'];
        });
        return $data;
    }
}
