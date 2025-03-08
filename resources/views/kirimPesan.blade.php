@extends('layouts.main')

@section('content')
    <div class="container bg-white rounded-lg p-7" style="margin-top: 5rem">
        <h1 class="">Send Message</h1>

        <form action="{{ route('send.message') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <label class="form-label">Select Device</label>
                <select class="form-select" name="device_token">
                    <option selected>Select Device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device['token'] ?? '' }}">{{ $device['name'] ?? 'N/A' }}</option>
                    @endforeach
                </select> 
                @error('device')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Input Target</label>
                <textarea class="form-control @error('target') is-invalid @enderror" name="target" rows="5" required
                    placeholder="1 Nomor Per Line">{{ old('target') }}</textarea>
                @error('target')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Delay</label>
                <input type="number" min="0" max="100" step="1"
                    class="form-control @error('delay') is-invalid @enderror" name="delay" value="{{ old('delay', 1) }}"
                    required>
                @error('delay')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">To</label>
                <input type="number" name="to" min="1" max="100" step="1"
                    class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}" required>
                @error('to')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" required name="message" rows="5"
                    placeholder="Hello World">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label class="form-label">Typing</label>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" name="typing" value="1"
                    {{ old('typing') ? 'checked' : '' }}>
                <label class="form-check-label">Set to on if you want to simulate typing</label>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Send Message</button>
            </div>
        </form>
    </div>
@endsection
