@extends('backend.layouts.master')
@section('title', __('backend.Edit Banner'))
@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
@endpush
@section('content')
    <form action="{{route('admin.banner.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Edit Banner') }}</h2>
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
                                   value="{{ old('header_title') ?? $banner->header_title }}"/>
                            @error('header_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Title') }}</label>
                            <input type="text" class="form-select @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') ?? $banner->title }}"/>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Sub Title') }}</label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('sub_title') is-invalid @enderror" name="sub_title"
                                      rows="4">
                                {{ old('sub_title') ?? $banner->sub_title}}
                            </textarea>
                            @error('sub_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('description') is-invalid @enderror" name="sub_title"
                                      rows="4">
                                {{ old('description') ?? $banner->description }}
                            </textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="1" @if($banner->status == 1 ? 'selected' : '') @endif>{{ __('backend.Published') }}</option>
                                <option value="0" @if($banner->status == 0 ? 'selected' : '') @endif>{{ __('backend.Draft') }}</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Link') }}</label>
                            <input type="text" class="form-select @error('link') is-invalid @enderror" name="link"
                                   value="{{$banner->link}} "/>
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Priority') }}</label>
                            <select class="form-select @error('priority') is-invalid @enderror" name="priority">
                                <option value="header" @if($banner->priority == 'header' ? 'selected' : '') @endif>
                                    {{ __('backend.Header') }}
                                </option>
                                <option value="gallery" @if($banner->priority == 'gallery' ? 'selected' : '') @endif>
                                    {{ __('backend.Gallery') }}
                                </option>
                            </select>
                            @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="input-upload">
                                <label class="form-label">{{ __('backend.Image') }}</label>
                                <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                                <input class="form-control @error('image') is-invalid @enderror" value="{{ $banner->image }}" type="file" id="images"
                                       name="image">
                                <img id="old_image" style="width:100%" src="{{ $banner->image_url }}" alt="">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </img>

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
