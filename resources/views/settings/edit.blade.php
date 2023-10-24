@extends('layouts.app')

@section('content-header', 'Pengaturan')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="card card-primary">
    <div class="card-header info">
    <h3 class="card-title">Pengaturan</h3>
</div>
</div>
</div>
</div>
@if (Auth::user()->role == 1 )
<div class="card">
    <div class="card-body">
        <form action="{{ route('settings.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="app_name">Nama Aplikasi</label>
                <input type="text" name="app_name" class="form-control @error('app_name') is-invalid @enderror" id="app_name" placeholder="Nama Aplikasi" value="{{ old('app_name', config('settings.app_name')) }}">
                @error('app_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="app_description">Deskripsi Aplikasi</label>
                <textarea name="app_description" class="form-control @error('app_description') is-invalid @enderror" id="app_description" placeholder="Deskripsi Aplikasi">{{ old('app_description', config('settings.app_description')) }}</textarea>
                @error('app_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="currency_symbol">Mata Uang</label>
                <input type="text" name="currency_symbol" class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" placeholder="Mata Uang" value="{{ old('currency_symbol', config('settings.currency_symbol')) }}">
                @error('currency_symbol')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="warning_quantity">Warning quantity</label>
                <input type="text" name="warning_quantity" class="form-control @error('warning_quantity') is-invalid @enderror" id="warning_quantity" placeholder="Warning quantity" value="{{ old('warning_quantity', config('settings.warning_quantity')) }}">
                @error('warning_quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}
            <div class="form-group">
                <!-- switch -->
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" value="1" name="date_system" {{ old('date_system', config('settings.date_system')) == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customSwitch1">Waktu Sistem</label>
                </div>
                <input type="time" {{ config('settings.date_system') != 1 ? 'disabled' : '' }} name="date_system_value" class="form-control mt-3 @error('date_system_value') is-invalid @enderror" id="date_system_value" placeholder="Date Time" value="{{ old('date_system_value', config('settings.date_system_value')) }}">

                @error('date_system')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endif

@if (Auth::user()->role == 2 )
<div class="card">
    <div class="card-body">
        <form action="{{ route('settings.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="app_name">Nama Aplikasi</label>
                <input type="text" name="app_name" class="form-control @error('app_name') is-invalid @enderror" id="app_name" placeholder="Nama Aplikasi" value="{{ old('app_name', config('settings.app_name')) }}" disabled>
                @error('app_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="app_description">Deskripsi Aplikasi</label>
                <textarea name="app_description" class="form-control @error('app_description') is-invalid @enderror" id="app_description" placeholder="Deskripsi Aplikasi" disabled>{{ old('app_description', config('settings.app_description')) }}</textarea>
                @error('app_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="currency_symbol">Mata Uang</label>
                <input type="text" name="currency_symbol" class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" placeholder="Mata Uang" value="{{ old('currency_symbol', config('settings.currency_symbol')) }}" disabled>
                @error('currency_symbol')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="warning_quantity">Warning quantity</label>
                <input type="text" name="warning_quantity" class="form-control @error('warning_quantity') is-invalid @enderror" id="warning_quantity" placeholder="Warning quantity" value="{{ old('warning_quantity', config('settings.warning_quantity')) }}">
                @error('warning_quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}
            <div class="form-group">
                <!-- switch -->
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" value="1" name="date_system" {{ old('date_system', config('settings.date_system')) == 1 ? 'checked' : '' }} disabled>
                    <label class="custom-control-label" for="customSwitch1">Waktu Sistem</label>
                </div>
                <input type="time" {{ config('settings.date_system') != 1 ? 'disabled' : '' }} name="date_system_value" class="form-control mt-3 @error('date_system_value') is-invalid @enderror" id="date_system_value" placeholder="Date Time" value="{{ old('date_system_value', config('settings.date_system_value')) }}" disabled>

                @error('date_system')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" disabled>Simpan</button>
        </form>
    </div>
</div>
@endif
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#customSwitch1').change(function() {
            if ($(this).prop('checked')) {
                $('#date_system_value').prop('disabled', false);
            } else {
                $('#date_system_value').prop('disabled', true);
            }
        });
    });
</script>
@endsection
