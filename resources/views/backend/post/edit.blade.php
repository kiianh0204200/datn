@extends('backend.layouts.master')
@section('title', 'Edit New Post')
@push('scripts')
    <script src="{{asset('backend/assets/js/product.js')}}"></script>
@endpush
@section('content')
    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-9">
                <div class="content-header">
                    <h2 class="content-title">{{ __('backend.Edit Post') }}</h2>
                    <div>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">{{ __('backend.Publish') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-4">
                            <label for="product_title" class="form-label">{{ __('backend.Post title') }}</label>
                            <input type="text" placeholder="Type here"
                                   class="form-control @error('title') is-invalid @enderror" id="product_title"
                                   name="title"
                                   value="{{ old('name') ?? $post->title }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Category') }}</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                <option> {{ __('backend.Select Category') }}</option>
                                @foreach($categories as $category)
                                    <option {{$post->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Post excerpt') }}</label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
                                      rows="4">
                                {{ old('excerpt') ?? $post->excerpt }}
                            </textarea>
                            @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('backend.Description') }}</label>
                            <textarea placeholder="Type here"
                                      class="form-control @error('description') is-invalid @enderror" name="description"
                                      rows="4">
                                {{ old('description') ?? $post->content }}
                            </textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div> <!-- card end// -->
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>{{ __('backend.Image') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="input-upload">
                            <label class="form-label">{{ __('backend.Image') }}</label>
                            <img src="{{asset('backend/assets/imgs/theme/upload.svg')}}" alt="">
                            <input class="form-control @error('thumbnail') is-invalid @enderror" value="{{$post->thumbnail}}" type="file" id="images"
                                   name="thumbnail">
                            <img id="old_image" src="{{$post->thumbnail_url}}" alt="">
                            @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="image-upload">
                            <div id="image_preview" style="width:100%;"></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
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
                        <hr>
                    </div>
                </div> <!-- card end// -->

            </div>
        </div>
    </form>
@endsection
