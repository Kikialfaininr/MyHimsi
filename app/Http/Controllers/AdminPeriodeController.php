<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Periode;
use Redirect;
use Session;
use PDF;

class AdminPeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('created_at', 'desc')->get();
        
        return view('admin-periode', compact('periode'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'periode' => 'unique:periode',
        ], [
            'periode.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-periode')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $periode = new Periode();
            $periode->periode = $request->periode;
            $periode->keterangan = $request->keterangan;
        $periode->save();
        return redirect('/admin-periode')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $periode = Periode::where('id_periode',$id)->first();
        return view('periode-edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'periode' => 'unique:periode,periode,' . $id . ',id_periode',
        ], [
            'periode.unique' => 'Gagal menyimpan data karena data sudah ada.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-periode')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $periode = periode::where('id_periode', $id)->first();
            $periode->periode = $request->periode;
            $periode->keterangan = $request->keterangan;
        $periode->save();
        return redirect('/admin-periode')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        $anggotaCount = $periode->anggota()->count();
        $divisiCount = $periode->divisi()->count();
        $jabatanCount = $periode->jabatan()->count();
        $prokerCount = $periode->proker()->count();

        if ($anggotaCount > 0 || $divisiCount > 0 || $jabatanCount > 0 || $prokerCount > 0) {
            return redirect('/admin-periode')->with('error', 'Tidak dapat menghapus periode karena terdapat data yang terkait.');
        }

        $periode->delete();
        return redirect('/admin-periode')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
