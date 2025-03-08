<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UpdateGrupController extends Controller
{
    public function index()
    {
        $member = Auth::user();
        $token = Auth::user()->tokenAkun;

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        $data = $response->json();

        if ($response->failed() || !isset($data['data'])) {
            Log::error('Gagal mengambil daftar perangkat dari API Fonnte', ['response' => $data]);
            return redirect()->back()->with('error', 'Gagal mengambil daftar perangkat.');
        }

        $devices = collect($data['data']);
        $groups = session('groups', []); // Ambil daftar grup dari session jika ada

        return view('updateGrup', compact('member', 'devices', 'groups'));
    }

    public function updateGroup(Request $request)
    {
        // Validasi input, pastikan token perangkat dipilih
        $request->validate([
            'device_name' => 'required|not_in:0'
        ], [
            'device_name.not_in' => 'Silakan pilih perangkat terlebih dahulu.'
        ]);

        // Ambil token dari form select option
        $token = $request->device_name;

        // Kirim permintaan ke API Fonnte
        $response = Http::withHeaders([
            'Authorization' => $token, // Gunakan token yang dipilih
        ])->post('https://api.fonnte.com/fetch-group');

        // Ambil respons dari API
        $data = $response->json();

        // Periksa apakah update berhasil
        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            return redirect()->back()->with('success', 'Grup berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui grup. Pastikan Device Sudah Connect.');
        }
    }
}
