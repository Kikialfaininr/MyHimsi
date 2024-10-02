<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordNotification;
use Illuminate\Support\Str;
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
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'id_anggota' => 'required|integer|unique:users,id_anggota',
        ], [
            'name.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
            'id_anggota.unique' => 'Anggota ini sudah memiliki akun.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-users')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        // Generate password random
        $randomPassword = Str::random(8);

        // Hash password sebelum disimpan ke database
        $hashedPassword = Hash::make($randomPassword);

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->id_anggota = $request->id_anggota;
        $user->role = 'Anggota';
        $user->save();

        // Kirim password ke email anggota
        Mail::to($user->email)->send(new PasswordNotification($user->name, $randomPassword));

        return redirect('/admin-users')->with([
            'message' => 'Data berhasil ditambah dan password telah dikirim ke email anggota.',
            'alert_class' => 'success'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $users = users::where('id_users',$id)->first();
        return view('users-edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'id_anggota' => 'required|integer',
            'id_anggota' => 'required|integer|unique:users,id_anggota,' . $id,
        ], [
            'name.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
            'id_anggota.unique' => 'Anggota ini sudah memiliki akun.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-users')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $user = Users::findOrFail($id);

        // Update data user kecuali password
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_anggota = $request->id_anggota;

        // Cek jika admin ingin mengubah password
        if ($request->filled('password')) {
            // Hash password baru
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan data user
        $user->save();

        return redirect('/admin-users')->with([
            'message' => 'Data berhasil diperbarui.',
            'alert_class' => 'success'
        ]);
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