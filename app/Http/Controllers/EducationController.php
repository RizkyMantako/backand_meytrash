<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index(Request $req)
    {
        $education = Edukasi::when($req->input('sampul'), function ($query, $sampul) {
            return $query->where('sampul', 'like', "%$sampul%");
        })->orderBy('id', 'asc')->paginate(10);
        return view('pages.edukasis.edukasi', compact('education'));
    }

    public function store(Request $req)
    {

        $req->validate([
            'sampul' => 'required',
            'judul' => 'required',
            'sumber' => 'required',
            'deskripsi' => 'required',
            'link_url' => 'required',
            'tags' => 'required',
        ]);
        $tagsArray = $req->input('tags', []);

        $filteredTags = array_filter($tagsArray, function ($value) {
            return $value !== null;
        });

        $formattedTags = json_encode($filteredTags);

        if ($req->hasFile('sampul')) {
            $imagePath = $req->file('sampul')->store('sampul_images', 'public');
            Edukasi::create([
                "sampul" => $imagePath,
                "judul" => $req->judul,
                "sumber" => $req->sumber,
                "deskripsi" => $req->deskripsi,
                "link_url" => $req->link_url,
                "tags" => $formattedTags ?? '[]',
            ]);

            return redirect()->route('edukasis.edukasi')->with('success', 'Edukasi added successfully');
        } else {
            return redirect()->back()->with('error', 'Image upload failed');
        }
    }

    public function edit(Request $request, $id)
    {
        $edukasi = Edukasi::findOrFail($id);
        return response()->json(['edukasi' => $edukasi]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'judul' => 'required',
            'sumber' => 'required',
            'deskripsi' => 'required',
            'link_url' => 'required',
            'tags' => 'required',
        ]);

        $edukasi = Edukasi::findOrFail($id);

        // Mendapatkan data input dari form
        $tagsArray = $request->input('tags', []);
        $filteredTags = array_filter($tagsArray, function ($value) {
            return $value !== null;
        });
        $formattedTags = json_encode($filteredTags);

        // Memeriksa apakah ada file gambar baru yang dikirimkan
        if ($request->hasFile('sampul')) {
            // Menghapus gambar lama jika ada
            if (Storage::disk('public')->exists($edukasi->sampul)) {
                Storage::disk('public')->delete($edukasi->sampul);
            }

            // Mengupload dan menyimpan gambar baru
            $imagePath = $request->file('sampul')->store('sampul_images', 'public');

            // Memperbarui data edukasi dengan gambar baru
            $edukasi->update([
                'sampul' => $imagePath,
                'judul' => $request->judul,
                'sumber' => $request->sumber,
                'deskripsi' => $request->deskripsi,
                'link_url' => $request->link_url,
                'tags' => $formattedTags ?? '[]',
            ]);
        } else {
            // Jika tidak ada gambar baru, hanya memperbarui data edukasi tanpa menyentuh gambar
            $edukasi->update([
                'judul' => $request->judul,
                'sumber' => $request->sumber,
                'deskripsi' => $request->deskripsi,
                'link_url' => $request->link_url,
                'tags' => $formattedTags ?? '[]',
            ]);
        }

        return redirect()->route('edukasis.edukasi')->with('success', 'Edukasi updated successfully');
    }

    // function hapus data
    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        $edukasi->delete();

        // Update ID
        Edukasi::where('id', '>', $id)->decrement('id');

        return redirect()->route('edukasis.edukasi')->with('success', 'User deleted successfully');
    }

    public function getList() {
        $edukasi = Edukasi::all();
        return response()->json([
            'success' => true,
            'data' => $edukasi
        ]);
    }

    public function detail($id)
    {
        $edukasi = Edukasi::find($id);

        if (!$edukasi) {
            return response()->json([
                'success' => false,
                'message' => 'Id tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $edukasi,
        ]);
    }
}
