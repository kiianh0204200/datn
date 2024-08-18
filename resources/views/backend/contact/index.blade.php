@extends('backend.layouts.master')
@section('title', __('backend.Contact Message List'))

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">{{ __('backend.Contact Message List') }} </h2>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        @can('delete contact management')
                            <th>Action</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td><b>{{ $contact->id }}</b></td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->created_at->format('d.m.Y, H:i') }}</td>
                            @can('delete contact management')
                                <td>
                                    <a href="{{ route('admin.contact.destroy',$contact->id) }}"
                                       class="btn btn-sm btn-danger font-sm rounded">Delete</a>
                                </td>
                            @endcan
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div> <!-- table-responsive.// -->
        </div>
    </div>
@endsection
