@extends('layouts.main')

@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-5">
                        <h3 class="mb-0">Device List</h3>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-lg-flex justify-content-between">
                                <div class="d-grid d-lg-block">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-modal">
                                        + Add Device
                                    </button>
                                </div>
                                <div class="d-flex mt-3 mt-lg-0">
                                    <form>
                                        <div class="input-group">
                                            <input class="form-control rounded-3 search" type="search"
                                                placeholder="Search">
                                            <span class="input-group-append">
                                                <button class="btn btn-dark" type="button">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Nomor</th>
                                                <th>Quota</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($devices as $device)
                                                <tr>
                                                    <td>{{ $device['name'] ?? 'N/A' }}</td>
                                                    <td>{{ $device['device'] ?? 'N/A' }}</td>
                                                    <td>{{ $device['quota'] ?? 'N/A' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $device['status'] == 'connect' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($device['status'] ?? 'unknown') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="action" style="display: flex;">
                                                            @if (isset($device['device']))
                                                                {{-- Tombol Connect / Disconnect --}}
                                                                {{-- @if ($device['status'] == 'disconnect')
                                                                <button class="btn btn-success btn-sm"
                                                                    onclick="connectDevice('{{ $device['device'] }}')">
                                                                    Connect
                                                                </button>
                                                            @else
                                                                <button class="btn btn-warning btn-sm"
                                                                    onclick="disconnectDevice('{{ $device['device'] }}')">
                                                                    Disconnect
                                                                </button>
                                                            @endif --}}

                                                                {{-- Tombol Copy Token --}}
                                                                <button class="btn btn-secondary btn-sm" style="margin-right: 0.2rem"
                                                                    onclick="copyToken('{{ $device['token'] ?? '' }}')">
                                                                    Copy Token
                                                                </button>

                                                                {{-- Tombol Delete --}}
                                                                <button class="btn btn-danger btn-sm"
                                                                    onclick="deleteDevice('{{ $device['device'] }}')">
                                                                    Delete
                                                                </button>
                                                            @else
                                                                <span class="text-danger">ID Not Found</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No Devices Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal QR Code -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">QR Code Activation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Scan QR Code di bawah ini untuk menghubungkan perangkat.</p>
                    <div id="qrContainer">
                        <img id="qrImage" src="" alt="QR Code" class="img-fluid d-none">
                        <p id="qrError" class="text-danger d-none">Gagal mendapatkan QR Code.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="contact-modal" tabindex="-1" aria-labelledby="contact-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="contact-modal-label">
                        Add Device
                    </h4>
                    <button type="button" class="btn-close" id="btn-close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('device.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="contact-name-field">Name</label>
                            <input type="text" class="form-control" placeholder="Device Name" name="name"
                                id="contact-name-field" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone-number-field">Device Number</label>
                            <input type="number" class="form-control" placeholder="62812345678" name="device"
                                id="phone-number-field" required />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                + Add Device
                            </button>
                            <button class="btn btn-light ms-2" data-bs-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function connectDevice(deviceId) {
        Swal.fire({
            title: "Hubungkan Perangkat?",
            text: "Apakah Anda yakin ingin menghubungkan perangkat ini?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Hubungkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/device/${deviceId}/connect`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire("Berhasil!", data.message, "success");
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan!", "error");
                    });
            }
        });
    }

    function disconnectDevice(deviceId) {
        Swal.fire({
            title: "Putuskan Perangkat?",
            text: "Apakah Anda yakin ingin memutuskan perangkat ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Putuskan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/device/${deviceId}/disconnect`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire("Berhasil!", data.message, "success");
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan!", "error");
                    });
            }
        });
    }

    function copyToken(token) {
        navigator.clipboard.writeText(token)
            .then(() => {
                Swal.fire("Berhasil!", "Token berhasil disalin!", "success");
            })
            .catch(err => {
                Swal.fire("Error!", "Gagal menyalin token.", "error");
            });
    }

    function deleteDevice(deviceId) {
        Swal.fire({
            title: "Hapus Perangkat?",
            text: "Perangkat akan dihapus secara permanen!",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/device/${deviceId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire("Berhasil!", data.message, "success");
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan!", "error");
                    });
            }
        });
    }

    document.getElementById("addDeviceForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        fetch("{{ route('device.add') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Berhasil!", data.message, "success").then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Gagal!", data.message || "Terjadi kesalahan", "error");
                }
            })
            .catch(error => {
                Swal.fire("Error!", "Terjadi kesalahan!", "error");
            });
    });

    function deleteDevice(deviceId) {
        Swal.fire({
            title: "Konfirmasi Hapus Perangkat",
            text: "Kami akan mengirimkan OTP ke WhatsApp Anda. Lanjutkan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Kirim OTP!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/device/request-otp/${deviceId}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Masukkan OTP",
                                input: "text",
                                inputPlaceholder: "Masukkan kode OTP dari WhatsApp",
                                showCancelButton: true,
                                confirmButtonText: "Hapus Perangkat",
                                cancelButtonText: "Batal",
                                inputValidator: (value) => {
                                    if (!value) {
                                        return "OTP wajib diisi!";
                                    }
                                }
                            }).then((otpResult) => {
                                if (otpResult.isConfirmed) {
                                    fetch(`/device/delete/${deviceId}`, {
                                            method: "DELETE",
                                            headers: {
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                "Content-Type": "application/json"
                                            },
                                            body: JSON.stringify({
                                                otp: otpResult.value
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                Swal.fire("Berhasil!", data.message, "success")
                                                    .then(() => {
                                                        location.reload();
                                                    });
                                            } else {
                                                Swal.fire("Gagal!", data.message, "error");
                                            }
                                        })
                                        .catch(error => {
                                            Swal.fire("Error!", "Terjadi kesalahan!", "error");
                                        });
                                }
                            });
                        } else {
                            Swal.fire("Gagal!", data.message, "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Terjadi kesalahan!", "error");
                    });
            }
        });
    }
</script>
