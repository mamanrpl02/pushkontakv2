@extends('layouts.main')

@section('content')
    <div class="container bg-white rounded-lg p-7" style="margin-top: 8rem">
        <h1>List Grup</h1>

        {{-- Select untuk memilih perangkat --}}
        <form method="GET" action="{{ route('list.group') }}">
            <div class="form-group">
                <label for="device-select">Pilih Perangkat:</label>
                <select name="device" id="device-select" class="form-control mt-1" onchange="this.form.submit()">
                    <option value="0" {{ request('device') == '0' ? 'selected' : '' }}>Pilih Device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device['token'] ?? 'N/A' }}"
                            {{ request('device') == ($device['token'] ?? 'N/A') ? 'selected' : '' }}>
                            {{ $device['name'] ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- List Grup --}}
        <div id="groups-container" class="mt-4">
            <h2>Daftar Grup</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="groups-table">
                    <thead>
                        <tr>
                            <th>Nama Grup</th>
                            <th>ID Grup</th>
                            <th>Jumlah Anggota</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($groups) && count($groups) > 0)
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group['name'] ?? 'N/A' }}</td>
                                    <td>
                                        {{ $group['id'] ?? 'N/A' }}
                                        <button onclick="copyToClipboard('{{ $group['id'] ?? '' }}')"
                                            class="btn btn-sm btn-secondary">Copy ID</button>
                                    </td>
                                    <td>{{ $group['member_count'] ?? 0 }}</td>
                                    <td>
                                        @php
                                            $members = is_array($group['member'])
                                                ? $group['member']
                                                : json_decode($group['member'], true);
                                            $members = is_array($members) ? $members : [];
                                        @endphp

                                        <button class="btn btn-sm btn-secondary copy-member-btn"
                                            data-members='@json($members)'>
                                            Copy Member
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada grup yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".copy-member-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let membersString = this.getAttribute("data-members");
                    console.log("Raw membersString:", membersString); // Debugging

                    try {
                        let members = JSON.parse(membersString);
                        console.log("Parsed members:", members); // Debugging

                        if (!Array.isArray(members) || members.length === 0) {
                            Swal.fire("Oops!", "Tidak ada nomor yang tersedia.", "warning");
                            return;
                        }

                        let textToCopy = members.map(member => member.trim()).join(
                        "\n"); // Pisahkan dengan baris baru

                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(textToCopy).then(() => {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Nomor anggota telah disalin.",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    timer: 2000
                                });
                            }).catch(err => {
                                Swal.fire("Oops!", "Gagal menyalin nomor.", "error");
                            });
                        } else {
                            let textArea = document.createElement("textarea");
                            textArea.value = textToCopy;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand("copy");
                            document.body.removeChild(textArea);

                            Swal.fire({
                                title: "Berhasil!",
                                text: "Nomor anggota telah disalin.",
                                icon: "success",
                                confirmButtonText: "OK",
                                timer: 2000
                            });
                        }
                    } catch (error) {
                        console.error("JSON Parsing Error:", error);
                        Swal.fire("Oops!", "Data tidak valid.", "error");
                    }
                });
            });
        });

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire("Berhasil!", "Teks telah disalin.", "success");
            }).catch(() => {
                Swal.fire("Oops!", "Gagal menyalin teks.", "error");
            });
        }
    </script>
@endsection
