@extends('admin.layout.template')
@section('title')
    {{ $backUrl }} EDIT
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('stisla-master/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla-master/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla-master/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endsection




@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route($backUrl) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit {{ $backUrl }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route($backUrl) }}">{{ $backUrl }}</a></div>
                    <div class="breadcrumb-item">Edit {{ $backUrl }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4>Edit {{ $backUrl }} About {{ $post->title }}</h4>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route($backUrl . '.update', $post->slug) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    {{-- title --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-md-left ">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $post->title }}">
                                                @error('title')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- genre --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-md-left">Genre</label>
                                                <select class="form-control selectric" name="genre_id">
                                                    @foreach ($genre as $item)
                                                        <option value="{{ $item->id }}" @if ($post->genre_id == $item->id) selected @endif>{{ $item->genre_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('genre_id')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- content --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-md-left">Content</label>
                                                <textarea class="summernote"
                                                    name="content">{{ $post->content }}</textarea>
                                                @error('content')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    {{-- status --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group  mb-4">
                                                <label class="form-label text-md-left ">Status</label>
                                                <div class="">
                                                    <select class="form-control selectric" name="status">
                                                        <option @if ($post->status == 'Publish') selected @endif>Publish</option>
                                                        <option @if ($post->status == 'Draft') selected @endif>Draft</option>
                                                        <option @if ($post->status == 'Pending') selected @endif>Pending</option>
                                                    </select>
                                                </div>
                                                @error('status')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    {{-- tags --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-md-left">Tags</label>
                                                <div class="">
                                                    <input type="text" class="inputtags form-control" name="tags"
                                                        value="{{ $post->tags }}">
                                                </div>
                                                @error('tags')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- cover --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-md-left ">Cover</label>
                                                <div class="">

                                                    <input type="file" name="cover" placeholder="Choose image" id="image">

                                                </div>
                                                @error('cover')
                                                    <span class=" text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img id="preview-image-before-upload"
                                                src="{{ asset('/images/post/cover/' . $post->cover) }}"
                                                alt="preview image" style="max-height: 250px;" class="img-fluid">
                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-group mb-4">
                            <label class="form-label text-md-left "></label>
                            <div class="">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('stisla-master/modules/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('stisla-master/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('stisla-master/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('stisla-master\assets\js\upload\jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('stisla-master/assets/js/page/features-post-create.js') }}"></script>
    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>
@endsection
