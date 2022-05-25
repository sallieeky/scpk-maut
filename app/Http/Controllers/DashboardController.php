<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $semua = $this->rankMaut(Staff::where("bulan", date("m"))->get());
        $departemen = Departemen::all();
        $departemen_arr = [];

        foreach ($departemen as $dep) {
            $temp = $this->rankMaut(Staff::where([['id_departemen', $dep->id], ["bulan", date("m")]])->get());
            $departemen_arr[$dep->nama] = $temp;
        }

        $rank_dep = $this->rankMaut(Staff::where([['id_departemen', Auth::user()->id_departemen], ["bulan", date("m")]])->get());

        return view("home", compact("semua", "departemen_arr", "rank_dep"));
    }

    public function kelolaAdmin()
    {
        $admin = User::where('role', 'admin')->get();
        $departemen = Departemen::all();
        return view("kelola-admin", compact("admin", "departemen"));
    }
    public function kelolaAdminTambah(Request $request)
    {
        $request["password"] = bcrypt($request->password);
        User::create($request->all());
        return back();
    }
    public function kelolaAdminEdit(Request $request, User $user)
    {
        if ($request->password == "") {
            $user->update($request->except('password'));
        } else {
            $request["password"] = bcrypt($request->password);
            $user->update($request->all());
        }
        return back();
    }
    public function kelolaAdminHapus(User $user)
    {
        $user->delete();
        return back();
    }

    public function kelolaStaff()
    {
        $staff = Staff::where([['id_departemen', Auth::user()->id_departemen], ["bulan", date('m')]])->get();
        $nilai = ["Sangat Baik", "Baik", "Cukup", "Kurang", "Sangat Kurang"];
        return view("kelola-staff", compact("staff", "nilai"));
    }
    public function kelolaStaffTambah(Request $request)
    {
        $request->merge(["id_departemen" => Auth::user()->id_departemen]);
        Staff::create($request->all());
        return back();
    }
    public function kelolaStaffEdit(Request $request, Staff $staff)
    {
        $staff->update($request->all());
        return back();
    }
    public function kelolaStaffHapus(Staff $staff)
    {
        $staff->delete();
        return back();
    }

    public function login()
    {
        return view("login");
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/login");
    }
    public function loginPost(Request $request)
    {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect("/");
        } else {
            return back();
        }
    }

    public function maut($data)
    {
        $kriteria = [
            "keaktifan" => [
                "Sangat Kurang" => 1,
                "Kurang" => 2,
                "Cukup" => 3,
                "Baik" => 4,
                "Sangat Baik" => 5,
            ],
            "tepat_waktu" => [
                "Sangat Kurang" => 1,
                "Kurang" => 2,
                "Cukup" => 3,
                "Baik" => 4,
                "Sangat Baik" => 5,
            ],
            "kontribusi" => [
                "Sangat Kurang" => 1,
                "Kurang" => 2,
                "Cukup" => 3,
                "Baik" => 4,
                "Sangat Baik" => 5,
            ],
            "sikap" => [
                "Sangat Kurang" => 1,
                "Kurang" => 2,
                "Cukup" => 3,
                "Baik" => 4,
                "Sangat Baik" => 5,
            ],
        ];

        $bobot_kriteria = [
            "keaktifan" => 40,
            "tepat_waktu" => 30,
            "kontribusi" => 20,
            "sikap" => 10,
        ];


        $pembobotan = [];
        for ($i = 0; $i < count($data); $i++) {
            $temp = [];
            $max_min = [];
            foreach ($kriteria as $key => $value) {
                $ktemp = $data[$i]->$key;
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
            $result[$i]->nilai = $nilai[$i];
        }
        return $result;
    }

    public function rankMaut($data)
    {
        $data = $this->maut($data);
        usort($data, function ($a, $b) {
            return $a->nilai < $b->nilai;
        });
        return $data;
    }
}
