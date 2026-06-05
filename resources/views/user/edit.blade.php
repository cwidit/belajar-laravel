@extends('layouts.app')
@section('title', 'Create New User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ??'' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('user.update', $edit->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Name *</label>
            <input type="text" class="form-control" placeholder="Enter your Name" name="name" required value="{{ $edit->name }}">
        </div>
        <div class="mb-3">
            <label for="">Email *</label>
            <input type="text" class="form-control" placeholder="Enter your Email" name="email" value="{{ $edit->email }}" required>
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="text" class="form-control" placeholder="Enter your Password" name="password">
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
        </form>
    </div>
</div>


@endsection
