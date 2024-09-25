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
        $event = Event::orderBy('tanggal', 'desc')
                    ->orderBy('waktu_mulai', 'desc')
                    ->get();
        
        return view('admin-event', compact('event'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Gambar tidak boleh lebih dari 10MB.',
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
    
            $image = Image::make($file->getRealPath());
            $image->save(public_path('image/event/'.$foto), 80);
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
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Gambar tidak boleh lebih dari 10MB.',
            ]);

            if ($validator->fails()) {
                return redirect('/admin-event')->with([
                    'message' => $validator->errors()->first(),
                    'alert_class' => 'danger'
                ]);
            }

            $event = Event::find($id);

            // Check if the "hapus_foto" checkbox is checked
            if ($request->has('hapus_foto')) {
                // Hapus foto lama jika ada
                if ($event->foto && file_exists(public_path('image/event/' . $event->foto))) {
                    unlink(public_path('image/event/' . $event->foto));
                }
                $event->foto = null; // Set foto to null in the database
            }

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $foto = 'Event-'.date('Ymdhis').'.'.$file->getClientOriginalExtension();

                $image = Image::make($file->getRealPath());
                $image->save(public_path('image/event/'.$foto), 80);

                // Hapus foto lama jika ada
                if ($event->foto && file_exists(public_path('image/event/' . $event->foto))) {
                    unlink(public_path('image/event/' . $event->foto));
                }

                $event->foto = $foto;
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
        } catch (\Exception $e) {
            // Tangkap error dan berikan alert kepada user
            return redirect('/admin-event')->with([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                'alert_class' => 'danger'
            ]);
        }
    }

    public function hapus(Request $request, $id)
    {
        $event = event::findOrFail($id);

        $event->delete();
        return redirect('/admin-event')->with('message', 'Data berhasil dihapus')->with('alert_class', 'success');
    }
}
