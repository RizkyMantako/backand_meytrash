<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\ProsesDonasi;
use App\Models\RiwayatDonasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{

    public function index(Request $req)
    {
        $donasis = DB::table('donasis')
            ->when($req->input('user_id'), function ($query, $user_id) {
                return $query->where('user_id', 'like', '%' . $user_id . '%');
            })->where('status', 'Dalam Antrian')
            ->orderBy('id', 'asc')->paginate(10);
        return view('pages.donasis.donasi', compact('donasis'));
    }

    public function proses(Request $request)
    {
        $proses_donasi = DB::table('proses_donasis')
            ->when($request->input('user_id'), function ($query, $user_id) {
                return $query->where('user_id', 'like', '%' . $user_id . '%');
            })->where('status', 'In Progres')
            ->orderBy('id', 'asc')->paginate(10);
        return view('pages.proses.proses_donasi', compact('proses_donasi'));
    }

    public function verifikasi(Request $req, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update([
            "status" => $req->status
        ]);
        if ($req->status == 'Terverifikasi') {
            ProsesDonasi::create([
                "user_id" => $donasi->user_id,
                "nama" => $donasi->nama,
                "no_hp" => $donasi->no_hp,
                "alamat" => $donasi->alamat,
                "foto_makanan" => $donasi->foto_makanan,
                "jenis_makanan" => $donasi->jenis_makanan,
                "berat_makanan" => $donasi->berat_makanan,
                "poin_transaksi" => $donasi->poin_transaksi,
                "deskripsi" => $donasi->deskripsi
            ]);
            return redirect('/proses_donasi');
        } else if ($req->status == 'Ditolak') {
            RiwayatDonasi::create([
                "user_id" => $donasi->user_id,
                "nama" => $donasi->nama,
                "no_hp" => $donasi->no_hp,
                "foto_makanan" => $donasi->foto_makanan,
                "jenis_makanan" => $donasi->jenis_makanan,
                "berat_makanan" => $donasi->berat_makanan,
                "poin_transaksi" => $donasi->poin_transaksi,
                "deskripsi" => $donasi->deskripsi,
                "status" => $req->status
            ]);
        }
        return redirect('/riwayat_donasi');
    }

    public function tolak(Request $request)
    {

        $riwayat_donasi = DB::table('riwayat_donasis')
            ->when($request->input('user_id'), function ($query, $user_id) {
                return $query->where('user_id', 'like', '%' . $user_id . '%');
            })
            ->orderBy('id', 'asc')->paginate(10);
        return view('pages.riwayat.riwayat_donasi', compact('riwayat_donasi'));
    }

    public function selesaiProses(Request $req, $id)
    {
        $donasi = ProsesDonasi::findOrFail($id);

        $donasi->update([
            "status" => "Selesai"
        ]);
        RiwayatDonasi::create([
            "user_id" => $donasi->user_id,
            "nama" => $donasi->nama,
            "no_hp" => $donasi->no_hp,
            "foto_makanan" => $donasi->foto_makanan,
            "jenis_makanan" => $donasi->jenis_makanan,
            "berat_makanan" => $donasi->berat_makanan,
            "poin_transaksi" => $donasi->poin_transaksi,
            "deskripsi" => $donasi->deskripsi,
            "status" => "Selesai",
        ]);

        $user = User::findOrFail($donasi->user_id);
        $user->update([
            'poin' => $user->poin + $donasi->poin_transaksi,
        ]);

        return redirect('/riwayat_donasi');
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto_makanan' => 'required',
            'deskripsi' => 'required',
            'jenis_makanan' => 'required',
            'status' => 'nullable',
        ]);

        $foto_makanan_path = null;
        if ($request->hasFile('foto_makanan')) {
            $foto_makanan = $request->file('foto_makanan');
            $foto_makanan_path = $foto_makanan->store('makanan_photos', 'public');
        }

        Donasi::create([
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'foto_makanan' => $foto_makanan_path,
            'deskripsi' => $data['deskripsi'],
            'jenis_makanan' => $data['jenis_makanan'],
            'status' => $data['status'],
        ]);
        return response()->json(['message' => 'Donasi created successfully.\n', $data], 201);
    }

    public function getList() {
        $donasi = Donasi::all()->whereIn('status', ['Dalam Antrian', 'dalam antrian']);
        return response()->json([
            'success' => true,
            'data' => $donasi
        ]);
    }

    public function detail($id)
    {
        $donasi = Donasi::find($id);

        if (!$donasi) {
            return response()->json([
                'success' => false,
                'message' => 'Id tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $donasi,
        ]);
    }

    // edit data donasi
    public function edit(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        return response()->json(['donasi'=>$donasi]);
    }

    // update data donasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required',
            'berat_makanan' => 'required|numeric',
            'poin_transaksi' => 'required|numeric',
        ]);

        $donasi = Donasi::findOrFail($id);
        $donasi->update ([
            'deskripsi' => $request->deskripsi,
            'berat_makanan' => $request->berat_makanan,
            'poin_transaksi' => $request->poin_transaksi,
        ]);
        return redirect()->back()->with('success', 'Donasi updated successfully');
    }
}
