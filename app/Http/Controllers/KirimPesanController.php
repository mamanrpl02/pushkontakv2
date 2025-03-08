<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KirimPesanController extends Controller
{
    public function index()
    {
        $member = Auth::user();
        $token = $member->tokenAkun; // Ambil token dari user yang login

        // Ambil daftar perangkat
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        $data = $response->json();

        // Pastikan perangkat tersedia
        $devices = isset($data['data']) ? collect($data['data']) : collect([]);

        return view('kirimPesan', compact('member', 'devices'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'device_token'  => 'required|string',
            'target'  => 'required|string',
            'message' => 'required|string|min:1|max:1000',
            'delay'   => 'required|integer|min:0|max:100',
            'to'      => 'required|integer|min:1|max:100',
        ], [
            'device.required'  => 'Silakan pilih perangkat.',
            'target.required'  => 'Target nomor harus diisi.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.min'      => 'Pesan minimal harus 1 karakter.',
            'message.max'      => 'Pesan maksimal 1000 karakter.',
            'delay.required'   => 'Delay harus diisi.',
            'delay.integer'    => 'Delay harus berupa angka.',
            'delay.min'        => 'Delay tidak boleh kurang dari 0.',
            'delay.max'        => 'Delay tidak boleh lebih dari 100.',
            'to.required'      => 'Kolom "To" harus diisi.',
            'to.integer'       => 'Kolom "To" harus berupa angka.',
            'to.min'           => 'Nilai "To" minimal 1.',
            'to.max'           => 'Nilai "To" maksimal 100.',
        ]);

        $deviceToken = $request->input('device_token'); // Ambil token device dari request
        $targets = explode("\n", trim($request->input('target'))); // Pecah target ke array per baris
        $message = $request->input('message');
        $delay   = $request->input('delay', 2);
        $typing  = $request->has('typing') ? true : false;

        // Format nomor agar menjadi 62xxxx (Indonesia)
        $formattedTargets = array_map(function ($target) {
            $target = trim($target);
            return preg_replace('/^0/', '62', $target); // Ubah 08xxxx menjadi 62xxxx
        }, $targets);

        // Kirim pesan ke Fonnte API
        $response = Http::withHeaders([
            'Authorization' => $deviceToken,
        ])->post('https://api.fonnte.com/send', [
            'target'      => implode(',', $formattedTargets), // Gabungkan nomor dengan koma
            'message'     => $message,
            'delay'       => $delay,
            'typing'      => $typing,
            'countryCode' => '62',
        ]);

        $result = $response->json();

        // Cek apakah API berhasil atau gagal
        if (isset($result['status']) && $result['status'] === true) {
            return back()->with('success', 'Pesan berhasil dikirim!');
        } else {
            return back()->with('error', 'Gagal mengirim pesan: ' . ($result['reason'] ?? 'Tidak diketahui'));
        }
    }
}
    