@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $post->judul }}</h1>
                <p> in {{ $post->category->nama }}</p>
                @if ($post->thumb)
                    <div style="max-height:350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->thumb) }}" class="img-fluid" alt="{{ $post->category->nama }}">
                    </div>
                @else
                    <img src="https://source.unsplash.com/random/1200x400?{{ $post->category->nama }}" class="img-fluid"
                        alt="{{ $post->category->nama }}">
                @endif


                <article class="my-3">
                    {!! $post->desc !!}
                </article>

                <a href="/dashboard/posts" class="btn btn-info"><span data-feather="arrow-left"
                        class="align-text-bottom"></span> Back All Post</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"
                        class="align-text-bottom"></span> Edit</a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="confirm('Yakin hapus data?')"><span data-feather="trash"
                            class="align-text-bottom"></span> Delete</button>
                </form>
                {{-- <a href="" class="btn btn-danger"><span data-feather="trash" class="align-text-bottom"></span> Delete</a> --}}
            </div>
        </div>
    </div>
@endsection
