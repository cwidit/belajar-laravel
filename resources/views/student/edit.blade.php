@extends('layouts.app')
@section('title', 'Student Management')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('student.update', $edit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Major *</label>
                    <select name="major_id" class="form-control" required>
                        <option value="">Select One</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" {{ $major->id == $edit->major_id ? 'selected' : '' }}>
                                {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Name *</label>
                    <input type="text" class="form-control" placeholder="Enter your Name" name="name" required
                        value="{{ $edit->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Phone *</label>
                    <input type="number" class="form-control" placeholder="Enter your Number" name="phone"
                        value="{{ $edit->phone }}">
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
            </form>
        </div>
    </div>


@endsection
