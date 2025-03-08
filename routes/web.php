<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KirimPesanController;
use App\Http\Controllers\UpdateGrupController;
use App\Http\Controllers\AdjustNumberController;
use App\Http\Controllers\GrupWhatsAppController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/grupwa-manzstr', function () {
    return view('gcstock');
})->name('grup');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:member')->group(function () {
    // Halaman utama perangkat
    Route::get('/device', [DeviceController::class, 'index'])->name('device');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
    Route::post('/devices/add', [DeviceController::class, 'addDevice'])->name('device.add');


    //Action
    Route::post('/devices/disconnect', [DeviceController::class, 'disconnect'])->name('device.disconnect');
    Route::post('/devices/connect', [DeviceController::class, 'connectDevice'])->name('device.connect');
    Route::post('/devices/qr', [DeviceController::class, 'getQrCode'])->name('device.qr');
    Route::post('/devices/reconnect', [DeviceController::class, 'reconnect'])->name('device.reconnect');
    Route::delete('/devices/{device}', [DeviceController::class, 'delete'])->name('devices.delete');
    Route::delete('/devices/{id}', [DeviceController::class, 'destroy'])->name('device.delete'); // Tambahkan route delete
    Route::post('/device/request-otp/{deviceId}', [DeviceController::class, 'requestOtp'])->name('device.requestOtp');
    Route::delete('/device/delete/{deviceId}', [DeviceController::class, 'deleteDevice'])->name('device.delete');

    Route::get('/fonnte/group/{groupId}/numbers', function ($groupId, Request $request) {
        $limit = $request->query('limit', 10); // Default ambil 10 nomor

        // Ambil token dari user yang login
        $token = Auth::user()->tokenAkun;

        // Request ke API Fonnte yang benar
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->get("https://api.fonnte.com/get-whatsapp-group");

        $data = $response->json();

        // Cek apakah respons berhasil
        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi API Fonnte',
                'error' => $response->body()
            ], 500);
        }

        // Pastikan ada data grup dalam response
        if (!isset($data['groups']) || !is_array($data['groups'])) {
            return response()->json([
                'success' => false,
                'message' => 'Data grup tidak ditemukan dalam respons API'
            ], 400);
        }

        // Cari grup berdasarkan ID yang diberikan
        $group = collect($data['groups'])->firstWhere('id', $groupId);

        if (!$group || !isset($group['member']) || !is_array($group['member'])) {
            return response()->json([
                'success' => false,
                'message' => 'Grup tidak ditemukan atau tidak memiliki anggota'
            ], 400);
        }

        // Ambil nomor anggota grup sesuai limit
        $numbers = collect($group['member'])->pluck('number')->take($limit)->toArray();

        return response()->json([
            'success' => true,
            'numbers' => $numbers
        ]);
    });

    Route::get('/adjust-nomor', [AdjustNumberController::class, 'index'])->name('adjustNomor');



    // GroupUpdate
    Route::get('/update-grup', [UpdateGrupController::class, 'index'])->name('upGroup.view');
    Route::post('/update-grup', [UpdateGrupController::class, 'updateGroup'])->name('upGroup.sub');

    // List Group
    Route::get('/list-group', [GrupWhatsAppController::class, 'index'])->name('list.group');
    Route::post('/list-group', [GrupWhatsAppController::class, 'getGroupsByDevice'])->name('showGroup');



    // Kirim pesan langsung dari perangkat
    Route::get('/send-message', [KirimPesanController::class, 'index'])->name('kirimPesan');
    Route::post('/send-message', [KirimPesanController::class, 'send'])->name('send.message');

    // Logout member
    Route::post('/member-logout', [AuthenticatedSessionController::class, 'destroy'])->name('member.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
