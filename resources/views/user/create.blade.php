@extends('layouts.app')
@section('title', 'Create New User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ??'' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="">Name *</label>
            <input type="text" class="form-control" placeholder="Enter your Name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="">Email *</label>
            <input type="text" class="form-control" placeholder="Enter your Email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="text" class="form-control" placeholder="Enter your Password" name="password" required>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
        </form>
    </div>
</div>


@endsection
