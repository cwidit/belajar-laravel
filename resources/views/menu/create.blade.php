@extends('layouts.app')
@section('title', 'Menu Management')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('menu.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" required
                            placeholder="Enter your Name">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="" class="form-label">Parent ID</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select One</option>
                            @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="Enter Icon">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Sort Order</label>
                        <input type="text" class="form-control" name="sort_order" placeholder="Enter Sort Order">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="Enter URL">
                    </div>
                    <div class="col-6 mt-3">
                        <label for="" class="form-label d-block">Status</label>
                        <input type="radio" name="is_active" value="1"> Active
                        <input type="radio" name="is_active" value="0"> Inactive
                    </div>
                    <div class="col-6 mb-3">
                        <div class="col-12">
                            <label class="form-label d-block">Assign to Roles</label>
                            @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}" >
                                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
