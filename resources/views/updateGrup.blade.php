@extends('layouts.main')

@section('content')
    <h1 style="margin-top: 5rem" class="p-7 pb-0">Update Grup</h1>
    <div class="container bg-white rounded-lg p-7">

        {{-- Form Pilih Perangkat --}}
        <form class="row g-3 needs-validation" action="{{ route('upGroup.sub') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3">
                <label class="form-label" for="deviceSelect">Pilih Perangkat</label>
                <select class="form-select" id="deviceSelect" name="device_name" required>
                    <option value="0" disabled>Pilih Device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device['token'] ?? '' }}"
                            {{ request('device') == ($device['token'] ?? '') ? 'selected' : '' }}>
                            {{ $device['name'] ?? 'Tidak Ada Nama' }}
                        </option>
                    @endforeach

                </select>

                @error('device_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Update Grup</button>
            </div>
        </form>
    </div>

    {{-- SweetAlert --}}
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 3000,
                    confirmButtonText: "Oke",
                }).then(() => {
                    let selectedDevice = document.getElementById("deviceSelect").value;

                    // Cegah redirect dengan nilai 0
                    if (selectedDevice === "0" || !selectedDevice) {
                        Swal.fire("Peringatan!", "Perangkat tidak valid!", "warning");
                        return;
                    }

                    window.location.href = "{{ route('list.group') }}?device=" + encodeURIComponent(
                        selectedDevice);
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButtonText : "Oke"
            });
        </script>
    @endif
@endsection
