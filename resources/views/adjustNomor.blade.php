@extends('layouts.main')

@section('content')
    <div class="container bg-white rounded-lg p-7" style="margin-top: 5rem">
        <h1 class="">Adjust Target</h1>
        <form class="row g-3 needs-validation" id="targetForm" novalidate>
            <div class="mb-3">
                <label for="textarea-input" class="form-label">Target</label>
                <textarea class="form-control" id="textarea-input" rows="5" placeholder="Enter Number" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="totalNumber">Total Number (Jumlah yang Disisakan)</label>
                <input type="number" id="totalNumber" name="totalNumber" class="form-control"
                    placeholder="Enter Total Number" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" id="copyButton" type="button">Copy Numbers</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const textarea = document.getElementById("textarea-input");
            const totalNumberInput = document.getElementById("totalNumber");
            const copyButton = document.getElementById("copyButton");
            const form = document.getElementById("targetForm");

            copyButton.addEventListener("click", function () {
                let numbersArray = textarea.value.trim().split("\n").filter(n => n);
                let total = parseInt(totalNumberInput.value);

                if (isNaN(total) || total <= 0) {
                    Swal.fire("Oops!", "Masukkan jumlah yang valid!", "warning");
                    return;
                }

                if (total > numbersArray.length) {
                    total = numbersArray.length;
                }

                let selectedNumbers = numbersArray.slice(0, total).join("\n");

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(selectedNumbers).then(() => {
                        showSuccessMessage();
                    }).catch(err => {
                        console.error("Clipboard API error:", err);
                        copyToClipboardFallback(selectedNumbers);
                    });
                } else {
                    copyToClipboardFallback(selectedNumbers);
                }
            });

            function copyToClipboardFallback(text) {
                let tempInput = document.createElement("textarea");
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                showSuccessMessage();
            }

            function showSuccessMessage() {
                Swal.fire({
                    title: "Berhasil!",
                    text: `${totalNumberInput.value} Nomor Telah disalin di Clipboard.`,
                    icon: "success",
                    confirmButtonText: "OK",
                    timer: 2000
                }).then(() => {
                    // Opsi 1: Reset Form Tanpa Reload
                    form.reset();

                    // Opsi 2: Reload Halaman Otomatis
                    // window.location.reload();
                });
            }
        });
    </script>
@endsection
