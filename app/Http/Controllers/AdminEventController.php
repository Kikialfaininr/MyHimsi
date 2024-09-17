<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use Redirect;
use Session;
use PDF;
use Image;

class AdminEventController extends Controller
{
    public function index()
    {
        $event = Event::orderBy('created_at', 'desc')->get();
        
        return view('admin-event', compact('event'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-event')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $foto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Event-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();
    
            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('image/event/'.$foto));
        }

        $event = new Event();
            $event->foto = $foto;
            $event->nama_event = $request->nama_event;
            $event->tanggal = $request->tanggal;
            $event->waktu_mulai = $request->waktu_mulai;
            $event->waktu_selesai = $request->waktu_selesai;
            $event->deskripsi = $request->deskripsi;
            $event->lokasi = $request->lokasi;
            $event->penyelenggara = $request->penyelenggara;
            $event->link_kegiatan = $request->link_kegiatan;
            $event->kategori = $request->kategori;
        $event->save();
        return redirect('/admin-event')->with('message', 'Data berhasil ditambah')->with('alert_class', 'success');      
    }

    public function edit(Request $request, $id)
    {
        $event = event::where('id_event',$id)->first();
        return view('event-edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/admin-event')->with([
                'message' => $validator->errors()->first(),
                'alert_class' => 'danger'
            ]);
        }

        $event = Event::find($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = 'Event-' . date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            
            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('image/event/'.$foto));

            // Hapus foto lama jika ada
            if ($event->foto && file_exists(public_path('image/event/' . $event->foto))) {
                unlink(public_path('image/event/' . $event->foto));
            }

            // Set foto baru ke variabel event
            $event->foto = $foto;
        } else {
            // Jika tidak ada file baru, pertahankan foto lama
            $foto = $event->foto;
        }

        // Update data event
        $event->nama_event = $request->nama_event;
        $event->tanggal = $request->tanggal;
        $event->waktu_mulai = $request->waktu_mulai;
        $event->waktu_selesai = $request->waktu_selesai;
        $event->deskripsi = $request->deskripsi;
        $event->lokasi = $request->lokasi;
        $event->penyelenggara = $request->penyelenggara;
        $event->link_kegiatan = $request->link_kegiatan;
        $event->kategori = $request->kategori;
        $event->save();

        return redirect('/admin-event')->with('message', 'Data berhasil diubah')->with('alert_class', 'success');
    }

    public function hapus(Request $request, $id)
    {
        $event = event::findOrFail($id);

        $event->delete();
        return redirect('/admin-event')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }

    public function downloadpdf()
    {
        $event = event::get();

        // Encode gambar ke base64
        $logoHimsi = public_path('image/logo himsi.png');
        $himsiData = base64_encode(file_get_contents($logoHimsi));
        $himsiSrc = 'data:image/png;base64,' . $himsiData;

        $logoUhb = public_path('image/logo uhb.png');
        $uhbData = base64_encode(file_get_contents($logoUhb));
        $uhbSrc = 'data:image/png;base64,' . $uhbData;

        // Ambil tanggal hari ini
        $currentDate = now()->format('d F Y'); // Format sesuai kebutuhan

        // Pass imageSrc dan currentDate ke view
        $pdf = PDF::loadview('pdf-event', compact('event', 'himsiSrc', 'uhbSrc', 'currentDate'));
        $pdf->setPaper('F4', 'landscape');
        return $pdf->stream('Data Event.pdf');
    }
}