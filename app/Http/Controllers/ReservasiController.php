<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailMeja;
use App\Models\ReservasiMeja;
use App\Models\Meja;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
// use Carbon\Carbon;
// use App\Http\Controllers\KapasitasController;
class ReservasiController extends Controller
{
    

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'no_telp' => 'required|numeric',
                'jumlah_orang' => 'required|integer|min:1',
                'detail_id' =>'required|integer',
                'tanggal_jam' => 'required|date_format:Y-m-d H:i:s',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            // Reservasi meja untuk walk-in
            $meja = Meja::whereDoesntHave('details', function ($query) {
                $query->where('status', '=', 'reserve');
            })->first();
    
            if (!$meja) {
                return response()->json(['error' => 'Tidak ada meja avail saat ini.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            // Cek apakah ada detail_meja yang sesuai dengan meja dan status avail
            $detailMeja = DetailMeja::where('id_meja', $meja->id)->where('status', 'avail')->first();
    
            if (!$detailMeja) {
                return response()->json(['error' => 'Detail meja tidak ditemukan atau tidak avail.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            // Tentukan nilai default untuk waktu kedatangan (0 menit)
            $defaultWaktuKedatangan = 30;
    
            // Set nilai default jika tidak diisi
            $waktuKedatangan = $request->filled('waktu_kedatangan') ? $request->input('waktu_kedatangan') : $defaultWaktuKedatangan;
    
            // Cek apakah jumlah_orang melebihi kapasitas meja yang tersedia
            if ($request->input('jumlah_orang') > $detailMeja->kapasitas->jumlah_orang) {
                return response()->json(['error' => 'Jumlah orang melebihi kapasitas meja yang tersedia.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            // Buat reservasi meja dengan waktu sekarang
            $reservasiData = $request->all();// Gunakan waktu sekarang
            $reservasiData['waktu_kedatangan'] = $waktuKedatangan; // Set waktu kedatangan
            $reservasi = ReservasiMeja::create($reservasiData);
    
            // Update status meja di detail_meja menjadi 'reserve'
            $detailMeja->status = 'reserve';
            $detailMeja->save();
    
            // Pastikan status di detail_meja telah diubah
            if ($detailMeja->status !== 'reserve') {
                return response()->json(['error' => 'Gagal memperbarui status meja.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
            $response = [
                'Success' => 'Reservasi Meja Berhasil ',
            ];
    
            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage(),
            ];
    
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


}

  
