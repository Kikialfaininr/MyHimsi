<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use DB;
use Hash;
use Image;

class ProfilAnggotaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $anggota = Anggota::with(['divisi', 'jabatan'])
                    ->where('id_anggota', $user->id_anggota)
                    ->get();

        $users = Users::where('id', $user->id)->get();

        return view('profil-anggota', compact('anggota', 'users', 'divisi', 'jabatan'));
    }

    public function anggota(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nim' => 'unique:anggota,nim,' . $id . ',id_anggota',
            ], [
                'nim.unique' => 'Gagal menyimpan data karena NIM sudah ada.',
            ]);

            if ($validator->fails()) {
                return redirect('/profil-anggota')->with([
                    'message' => $validator->errors()->first(),
                    'alert_class' => 'danger'
                ]);
            }

            $anggota = Anggota::find($id);

            // Update data anggota
            $anggota->full_name = $request->full_name;
            $anggota->nim = $request->nim;
            $anggota->angkatan = $request->angkatan;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->id_divisi = $request->id_divisi;
            $anggota->id_jabatan = $request->id_jabatan;
            $anggota->link_ig = $request->link_ig;
            $anggota->link_linkedin = $request->link_linkedin;
            $anggota->save();

            return redirect('/profil-anggota')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
        } catch (\Exception $e) {
            // Tangkap error dan berikan alert kepada user
            return redirect('/profil-anggota')->with([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function image(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 10MB.',
            ]);

            if ($validator->fails()) {
                return redirect('/profil-anggota')->with([
                    'message' => $validator->errors()->first(),
                    'alert_class' => 'danger'
                ]);
            }

            $anggota = Anggota::find($id);

            // Check if the "hapus_foto" checkbox is checked
            if ($request->has('hapus_foto')) {
                // Hapus foto lama jika ada
                if ($anggota->foto && file_exists(public_path('image/anggota/' . $anggota->foto))) {
                    unlink(public_path('image/anggota/' . $anggota->foto));
                }
                $anggota->foto = null; // Set foto to null in the database
            }

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $foto = 'Anggota-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();

                $image = Image::make($file->getRealPath());
                $image->save(public_path('image/anggota/'.$foto), 80);

                // Hapus foto lama jika ada
                if ($anggota->foto && file_exists(public_path('image/anggota/' . $anggota->foto))) {
                    unlink(public_path('image/anggota/' . $anggota->foto));
                }

                $anggota->foto = $foto;
            }

            $anggota->save();

            return redirect('/profil-anggota')->with('message', 'Foto berhasil diubah')->with('alert_class', 'success');
        } catch (\Exception $e) {
            // Tangkap error dan berikan alert kepada user
            return redirect('/profil-anggota')->with([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function login(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:users,name,' . $id,
            'password' => 'nullable|confirmed',
        ], [
            'name.unique' => 'Gagal menyimpan data karena data sudah ada.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect('/profil-anggota')->with([
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
        return redirect('/profil-anggota')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

}

