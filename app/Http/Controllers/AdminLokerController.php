<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Loker;
use Redirect;
use Session;
use PDF;

class AdminLokerController extends Controller
{
    public function index()
    {
        $loker = Loker::orderBy('created_at', 'desc')->get();
        
        return view('admin-loker', compact('loker'));
    }

    public function simpan(Request $request)
    {
        $loker = new Loker();
            $loker->posisi = $request->posisi;
            $loker->deskripsi = $request->deskripsi;
            $loker->nama_perusahaan = $request->nama_perusahaan;
            $loker->lokasi = $request->lokasi;
            $loker->gaji = $request->gaji;
            $loker->jenis_pekerjaan = $request->jenis_pekerjaan;
            $loker->link_apply = $request->link_apply;
        $loker->save();
        return redirect('/admin-loker')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $loker = Loker::where('id_loker',$id)->first();
        return view('loker-edit', compact('loker'));
    }

    public function update(Request $request, $id)
    {
        $loker = Loker::where('id_loker', $id)->first();
            $loker->posisi = $request->posisi;
            $loker->deskripsi = $request->deskripsi;
            $loker->nama_perusahaan = $request->nama_perusahaan;
            $loker->lokasi = $request->lokasi;
            $loker->gaji = $request->gaji;
            $loker->jenis_pekerjaan = $request->jenis_pekerjaan;
            $loker->link_apply = $request->link_apply;
        $loker->save();
        return redirect('/admin-loker')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $loker = loker::findOrFail($id);

        $loker->delete();
        return redirect('/admin-loker')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
