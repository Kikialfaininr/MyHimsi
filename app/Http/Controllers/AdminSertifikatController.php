<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sertifikat;
use Redirect;
use Session;
use PDF;

class AdminSertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::orderBy('created_at', 'desc')->get();
        
        return view('admin-sertifikat', compact('sertifikat'));
    }

    public function simpan(Request $request)
    {
        $sertifikat = new Sertifikat();
            $sertifikat->nama_sertifikat = $request->nama_sertifikat;
            $sertifikat->link_sertifikat = $request->link_sertifikat;
            $sertifikat->kategori = $request->kategori;
        $sertifikat->save();
        return redirect('/admin-sertifikat')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $sertifikat = Sertifikat::where('id_sertifikat',$id)->first();
        return view('sertifikat-edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::where('id_sertifikat', $id)->first();
            $sertifikat->nama_sertifikat = $request->nama_sertifikat;
            $sertifikat->link_sertifikat = $request->link_sertifikat;
            $sertifikat->kategori = $request->kategori;
        $sertifikat->save();
        return redirect('/admin-sertifikat')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $sertifikat->delete();
        return redirect('/admin-sertifikat')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
