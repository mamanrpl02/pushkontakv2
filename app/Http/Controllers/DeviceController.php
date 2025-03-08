<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DeviceController extends Controller
{
    // Menampilkan daftar perangkat
    public function index()
    {
        $token = Auth::user()->tokenAkun;
        $member = Auth::user();

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        $data = $response->json();

        // Pastikan ada data perangkat sebelum mengaksesnya
        $devices = isset($data['data']) ? collect($data['data']) : collect([]);

        return view('device', compact('devices', 'member'));
    }


    public function addDevice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'device' => 'required|string|unique:devices,device',
        ]);

        $token = Auth::user()->tokenAkun;

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/add-device', [
            'name' => $request->input('name'),
            'device' => $request->input('device'),
        ]);

        if ($response->successful()) {
            return redirect()->route('device')->with('success', 'Device added successfully.');
        } else {
            return redirect()->route('device')->with('error', 'Failed to add device.');
        }
    }

    public function requestOtp($deviceId)
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_API_KEY')
        ])->post('https://api.fonnte.com/request-delete-otp', [
            'device' => $deviceId
        ]);

        $responseData = $response->json(); // Ambil respon dari API

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP telah dikirim ke WhatsApp Anda'
            ]);
        } else {
            Log::error('Gagal mengirim OTP', ['response' => $responseData]); // Catat error di log
            return response()->json([
                'success' => false,
                'message' => $responseData['message'] ?? 'Gagal mengirim OTP'
            ]);
        }
    }


    public function deleteDevice(Request $request, $deviceId)
    {
        $otp = $request->input('otp'); // Ambil OTP dari request
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_API_KEY')
        ])->delete('https://api.fonnte.com/delete-device', [
            'device' => $deviceId,
            'otp'    => $otp
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Perangkat berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'OTP salah atau terjadi kesalahan']);
        }
    }
}
