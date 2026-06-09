@extends('layouts.app')
@section('title', 'Student Management')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ??'' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('student.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="">Major *</label>
            <select name="major_id" id="" class="form-control">
                <option value="">Select One</option>
                @foreach ($majors as $major)
                <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control" placeholder="Enter your Name" name="major_id" required>
        </div>
        <div class="mb-3">
            <label for="">Name *</label>
            <input type="text" class="form-control" placeholder="Enter your Name" name="name" required >
        </div>
         <div class="mb-3">
            <label for="">Phone *</label>
            <input type="number" class="form-control" placeholder="Enter your Number" name="phone" >
        </div>


        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
        </form>
    </div>
</div>


@endsection
