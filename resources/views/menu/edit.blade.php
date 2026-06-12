@extends('layouts.app')
@section('title', 'Edit Menu')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Menu</h3>
    </div>

<div class="card-body">
    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Name *</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{ old('name', $menu->name) }}"
                       required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Parent Menu</label>
                <select name="parent_id" class="form-control">
                    <option value="">Select One</option>

                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}"
                            {{ $parent->id == $menu->parent_id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Icon</label>
                <input type="text"
                       class="form-control"
                       name="icon"
                       value="{{ old('icon', $menu->icon) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number"
                       class="form-control"
                       name="sort_order"
                       value="{{ old('sort_order', $menu->sort_order) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">URL</label>
                <input type="text"
                       class="form-control"
                       name="url"
                       value="{{ old('url', $menu->url) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Status</label>

                <input type="radio"
                       name="is_active"
                       value="1"
                       {{ $menu->is_active == 1 ? 'checked' : '' }}>
                Active

                <input type="radio"
                       name="is_active"
                       value="0"
                       {{ $menu->is_active == 0 ? 'checked' : '' }}>
                Inactive
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label d-block">Assign Roles</label>

                @foreach ($roles as $role)
                    <div class="form-check form-check-inline">
                        <input type="checkbox"
                               class="form-check-input"
                               name="roles[]"
                               value="{{ $role->id }}"
                               {{ in_array($role->id, $menuRoles) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>
        <a href="{{ route('menu.index') }}"
           class="btn btn-secondary">
            Back
        </a>
    </form>
</div>
</div>
@endsection
