<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\Jabatan;
use App\Models\Anggota;
use Redirect;
use Session;
use Hash;
use DB;
use PDF;

class AdminUsersController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        
        $users = Users::with(['anggota'])
                    ->where('role', 'Anggota')
                    ->orderBy('created_at', 'DESC')
                    ->get();
        
        return view('admin-users', compact('users', 'anggota'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:users',
            'password' => 'required|confirmed',
        ], [
            'name.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-users')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $users = new Users();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->id_anggota = $request->id_anggota;
        $users->role = 'Anggota';
        $users->save();
        return redirect('/admin-users')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }


    public function edit(Request $request, $id)
    {
        $users = users::where('id_users',$id)->first();
        return view('users-edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:users,name,' . $id,
            'password' => 'nullable|confirmed',
        ], [
            'name.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-users')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $users = Users::where('id', $id)->first();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->id_anggota = $request->id_anggota;
        
        if ($request->filled('password')) {
            $users->password = Hash::make($request->password);
        }

        $users->save();
        return redirect('/admin-users')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $users = users::findOrFail($id);
        $users->delete();
        return redirect('/admin-users')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $jabatan = Jabatan::all();
        $anggota = Anggota::with(['divisi', 'jabatan'])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $users = users::with(['anggota'])
                        ->where('role', 'Anggota')
                        ->orderBy('created_at', 'DESC')
                        ->get();

        // Cari anggota dengan jabatan "Ketua Umum"
        $ketuaUmum = Anggota::whereHas('jabatan', function($query) {
            $query->where('nama_jabatan', 'Ketua Umum');
        })->first();

        // Encode gambar ke base64
        $logoHimsi = public_path('image/logo himsi.png');
        $himsiData = base64_encode(file_get_contents($logoHimsi));
        $himsiSrc = 'data:image/png;base64,' . $himsiData;

        $logoUhb = public_path('image/logo uhb.png');
        $uhbData = base64_encode(file_get_contents($logoUhb));
        $uhbSrc = 'data:image/png;base64,' . $uhbData;

        // Ambil tanggal hari ini
        $currentDate = now()->format('d F Y');

        $pdf = PDF::loadview('pdf-users', compact('users', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum'));
        $pdf->setPaper('F4', 'potrait');
        return $pdf->stream('Data Login Anggota Himsi.pdf');
    }

    public function downloadpdfByAngkatan(Request $request)
    {
        $angkatan = $request->input('angkatan');
        $users = Users::with('anggota')
                        ->whereHas('anggota', function($query) use ($angkatan) {
                            $query->where('angkatan', $angkatan);
                        })
                        ->where('role', 'Anggota')
                        ->orderBy('created_at', 'DESC')
                        ->get();

        // Cari anggota dengan jabatan "Ketua Umum"
        $ketuaUmum = Anggota::whereHas('jabatan', function($query) {
            $query->where('nama_jabatan', 'Ketua Umum');
        })->first();

        // Encode gambar ke base64
        $logoHimsi = public_path('image/logo himsi.png');
        $himsiData = base64_encode(file_get_contents($logoHimsi));
        $himsiSrc = 'data:image/png;base64,' . $himsiData;

        $logoUhb = public_path('image/logo uhb.png');
        $uhbData = base64_encode(file_get_contents($logoUhb));
        $uhbSrc = 'data:image/png;base64,' . $uhbData;

        // Ambil tanggal hari ini
        $currentDate = now()->format('d F Y');

        $pdf = PDF::loadview('pdf-angkatanusers', compact('users', 'himsiSrc', 'uhbSrc', 'currentDate', 'ketuaUmum', 'angkatan'));
        $pdf->setPaper('F4', 'potrait');
        return $pdf->stream('Data Login Anggota Himsi Per Angkatan ' . $angkatan . '.pdf');
    }


}