@extends('layouts.app')
@section('title', 'Create New Locker')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ??'' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('locker.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="">Locker Code *</label>
            <input type="number" class="form-control @errorr ('locker_name') is_invalid @enderrorr" value="{{ old('locker_name') }}"
            placeholder="Enter Locker Code" name="locker_name" required>
            @error('locker_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Batch *</label>
            <select name="batch" class="form-select" required>
                <option value="">--Choose Batch--</option>
                <option value="1">Batch 1</option>
                <option value="2">Batch 2</option>
                <option value="3">Batch 3</option>
                <option value="4">Batch 4</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Major *</label>
             <select name="major_name" class="form-select" required>
                <option value="">--Choose Major--</option>
                <option value="Web Programming">Web Programming</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Content Creator">Content Creator</option>
                <option value="Teknisi Jaringan">Teknisi Jaringan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Status *</label>
             <select name="status" class="form-select" required>
                <option value="">--Choose Status--</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
                <option value="Damaged">Damaged</option>
                <option value="Missing">Missing</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
        </form>
    </div>
</div>


@endsection
