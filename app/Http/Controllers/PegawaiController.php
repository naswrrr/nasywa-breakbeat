<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
        'name' => 'Nasywa',
        'hobbies' => ['Membaca', 'Menulis', 'Bermain Musik', 'Olahraga', 'Memasak'],
        'tgl_harus_wisuda' => '2028-10-15',
        'current_semester' => 3,
        'future_goal' => 'Menjadi Software Engineer'
    ];

         // Hitung umur
         $birthdate = new DateTime('2006-09-20');
         $today = new DateTime();
         $ageInterval = $today->diff($birthdate);
         $data['my_age'] = $ageInterval->y;

         // Hitung sisa hari ke wisuda
         $tgl1 = strtotime(date('Y-m-d'));
         $tgl2 = strtotime($data['tgl_harus_wisuda']);
         $data['time_to_study_left'] = (int)(($tgl2 - $tgl1) / 60 / 60 / 24);

         // Tambahkan informasi semester
         if ($data['current_semester'] < 3) {
             $data['semester_info'] = 'Masih Awal, Kejar TAK';
        } else {
            $data['semester_info'] = 'Jangan main-main, kurang-kurangi main game!';
    }

    return view('pegawai', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
