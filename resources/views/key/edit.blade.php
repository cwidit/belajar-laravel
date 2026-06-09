@extends('layouts.app')
@section('title', 'Key Management')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ??'' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('key.update', $edit->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Name *</label>
            <input type="text" class="form-control" placeholder="Enter your Name" name="name" required value="{{ $edit->name }}">
        </div>
        <div class="mb-3">
            <label for="">Status *</label>
            <input type="radio" name="is_active" value="1" {{ $edit->is_active==1?'checked':'' }}>Active
            <input type="radio" name="is_active" value="0" {{ $edit->is_active==0?'checked':'' }}>Inactive
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
        </form>
    </div>
</div>


@endsection
