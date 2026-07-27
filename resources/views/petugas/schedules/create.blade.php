@extends('layouts.petugas')

@section('title', 'Input Jadwal Petugas')
@section('page-title', 'Input Jadwal Petugas')

@section('content')
    <div class="content-card">
        <h5 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i>Input Jadwal Petugas</h5>
        
        <form action="{{ route('petugas.schedules.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Hari</label>
                    <input type="text" name="day" class="form-control" placeholder="Senin - Jumat" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Petugas</label>
                    <input type="text" name="officer_name" class="form-control" placeholder="Nama Petugas" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jam Tugas</label>
                    <input type="text" name="time" class="form-control" placeholder="07:00 - 15:00" required>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('petugas.schedules.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </div>
        </form>
    </div>
@endsection