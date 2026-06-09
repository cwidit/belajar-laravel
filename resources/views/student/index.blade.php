@extends('layouts.app') //
@section('title', 'Student Management')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ?? '' }}</h3>
    </div>
    <div class="card-body">
        <div class="mb-3" align="right">
            <a href="{{ route('student.create') }}" class="btn btn-primary">Create New Student</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Major</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index +=1 }}</td>
                    <td>{{ $student->name??'' }}</td>
                    <td>{{ $student->major->name??'' }}</td>
                    <td>{{ $student->phone??'' }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-success icon">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
