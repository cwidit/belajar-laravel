@extends('layouts.app')
@section('title', 'Create New Role')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('role.update', $edit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name *</label>
                    <input type="text" class="form-control" placeholder="Enter your Name" name="name" required
                        value="{{ $edit->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Status *</label>
                    <input type="radio" name="is_active" value="1"
                        {{ $edit->is_active == 1 ? 'checked' : '' }}>Active
                    <input type="radio" name="is_active" value="0"
                        {{ $edit->is_active == 0 ? 'checked' : '' }}>Inactive
                </div>

                <div class="row">
                    @foreach ($parents as $parent)
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" name="menu_ids[]"
                                        value="{{ $parent->id }}">
                                    <label for="" class="form-check-label fw-bold">{{ $parent->name }}</label>
                                </div>

                                @foreach ($parent->children as $child)
                                    {{-- ms=margin start --}}
                                    <div class="form-check ms-3">
                                        <input type="checkbox" name="menu_ids[]" class="form-check-input" value="{{ $child->id }}">
                                        <label for="">{{ $child->name }}</label>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    @endforeach

                </div>

                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ url()->previous() }}" class="text-secondary">Back</a>
            </form>
        </div>
    </div>


@endsection
