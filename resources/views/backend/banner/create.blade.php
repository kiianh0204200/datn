@extends('backend.layouts.master')
@section('title', __('backend.Add New Banner'))
@section('content')
    <form action="{{route('admin.banner.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Add New Banner') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Header title') }}</label>
                            <input type="text" class="form-select @error('header_title') is-invalid @enderror" name="header_title"
                                   value="{{ old('header_title') }}"/>
                            @error('header_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Title') }}</label>
                            <input type="text" class="form-select @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') }}"/>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Sub Title') }}</label>
                            <input placeholder="Type here"
                                      class="form-control @error('sub_title') is-invalid @enderror" name="sub_title"
                                      rows="4">
                                {{ old('sub_title') }}
                            </input>
                            @error('sub_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('description') is-invalid @enderror" name="description"
                                      rows="4">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="1">{{ __('backend.Published') }}</option>
                                <option value="0">{{ __('backend.Draft') }}</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Link') }}</label>
                            <input type="text" class="form-select @error('link') is-invalid @enderror" name="link"
                                   value="{{ old('link') }}"/>
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Priority') }}</label>
                            <select class="form-select @error('priority') is-invalid @enderror" name="priority">
                                <option value="header">{{ __('backend.Header') }} </option>
                                <option value="gallery">{{ __('backend.Gallery') }} </option>
                            </select>
                            @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="input-upload">
                                <label class="form-label">{{ __('backend.Image') }}</label>
                                <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="images"
                                       name="image">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="image-upload">
                                <div id="image_preview" style="width:100%;"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- card end// -->
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
@endpush
