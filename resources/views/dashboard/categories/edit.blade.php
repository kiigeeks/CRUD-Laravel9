@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Category</h1>
</div>

@if (session()->has('categoryErr'))
    <div class="alert alert-danger alert-dismissible fade show col-lg-6" role="alert">
        {{ session('categoryErr') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="col-md-6">
    <form method="post" action="/dashboard/categories/{{ $category->slug }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            @error('nama')
                <div class="invalid-feedback" >
                    {{ $message }}
                </div>
            @enderror
            <input type="text" class="form-control @error('nama') is-invalid @enderror nama" id="nama" name="nama" value="{{ old('nama', $category->nama) }}" autofocus required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            @error('slug')
                <div class="invalid-feedback" >
                    {{ $message }}
                </div>
            @enderror
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ old('slug', $category->slug) }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function(){
        fetch('/dashboard/categories/checkSlug?nama=' + nama.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });
</script>
@endsection
