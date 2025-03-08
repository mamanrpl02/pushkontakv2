<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GrupWhatsAppController extends Controller
{
    public function index(Request $request)
    {
        $member = Auth::user();
        $token = Auth::user()->tokenAkun;

        // Ambil data perangkat dari API Fonnte
        $responseDevices = Http::withHeaders([
            'Authorization' => $token, // Ganti dengan token Fonnte Anda
        ])->post('https://api.fonnte.com/get-devices');

        $dataDevices = $responseDevices->json();
        $devices = $dataDevices['data'] ?? [];

        // Ambil nilai perangkat yang dipilih dari request
        $selectedDeviceToken = $request->input('device');

        // Inisialisasi grup
        $groups = [];

        // Jika ada perangkat yang dipilih, ambil data grup
        if ($selectedDeviceToken && $selectedDeviceToken !== '0') {
            // Ambil data grup dari API Fonnte
            $responseGroups = Http::withHeaders([
                'Authorization' => $selectedDeviceToken, // Gunakan token perangkat yang dipilih
            ])->post('https://api.fonnte.com/get-whatsapp-group');

            $dataGroups = $responseGroups->json();
            $groups = $dataGroups['data'] ?? [];

            // Uraikan jumlah anggota dari string JSON
            foreach ($groups as &$group) {
                // Mengubah string JSON menjadi array
                $membersArray = json_decode($group['member'], true);
                // Hitung jumlah anggota
                $group['member_count'] = is_array($membersArray) ? count($membersArray) : 0;
            }
        }

        // Kirim data ke tampilan
        return view('listGroup', compact('devices', 'member', 'groups'));
    }
}
