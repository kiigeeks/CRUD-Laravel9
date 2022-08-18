@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">New Post</h1>
</div>

@if (session()->has('postErr'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
        {{ session('postErr') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="col-md-6">
    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            @error('judul')
                <div class="invalid-feedback" >
                    {{ $message }}
                </div>
            @enderror
            <input type="text" class="form-control @error('judul') is-invalid @enderror judul" id="judul" name="judul" value="{{ old('judul') }}" autofocus required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            @error('slug')
                <div class="invalid-feedback" >
                    {{ $message }}
                </div>
            @enderror
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ old('slug') }}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id">
                @foreach ($categories as $category)
                    @if (old('category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->nama }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="thumb" class="form-label">Image Header</label>
            <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
            <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb" onchange="previewImage()">
            @error('thumb')
                <div class="invalid-feedback" >
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Desc</label>
            @error('desc')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="desc" type="hidden" name="desc" value="{{ old('desc') }}">
            <trix-editor input="desc"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?judul=' + judul.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });

    //hilangkan upload file di trix editor
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    function previewImage(){
        const image = document.querySelector('#thumb');
        const imgPreview = document.querySelector('.img-preview')

        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    }
</script>
@endsection
