@extends('backend.layouts.master')
@section('title', 'Add New Role')
@section('content')
    <form action="{{ route('admin.role.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">Add New Role</h2>
                    <div>
                        <button class="btn btn-md rounded font-sm hover-up">Publish</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Role Name</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('name') is-invalid @enderror" id="product_title" name="name"
                                   value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Import From Role</label>
                            <select class="form-select" name="role_id">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
