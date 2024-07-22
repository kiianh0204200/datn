@extends('backend.layouts.master')
@section('title', 'Edit Role')
@section('content')
    <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">Add New Role</h2>
                    <div>
                        <button class="btn btn-md rounded font-sm hover-up">Publish</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Role Name</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('name') is-invalid @enderror" id="product_title"
                                   name="name"
                                   value="{{ old('name') ?? $role->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-2">
                                    <div class="form-switch mt-2">
                                        <input class="form-check-input @error('permission[]') is-invalid @enderror"
                                               type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                               id="flexSwitchCheckDefault">
                                        <label class="form-check-label"
                                               for="flexSwitchCheckDefault"> {{$permission->name}} </label>
                                    </div>
                                </div>
                            @endforeach

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
