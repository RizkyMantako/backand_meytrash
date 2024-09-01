<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatDonasi;
use App\Models\RiwayatSampah;

class RiwayatController extends Controller
{
    public function getListDonasi(Request $request){
        $userId = $request->input('user_id');
        $data = RiwayatDonasi::where('user_id', $userId)
                ->whereIn('status', ['Selesai', 'selesai', 'Ditolak', 'ditolak'])
                ->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getDetailDonasi($id){
        $data = RiwayatDonasi::find($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getListSampah(Request $request){
        $userId = $request->input('user_id');
        $data = RiwayatSampah::where('user_id', $userId)
                ->whereIn('status', ['Selesai', 'selesai', 'Ditolak', 'ditolak'])
                ->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getDetailSampah($id){
        $data = RiwayatSampah::find($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
