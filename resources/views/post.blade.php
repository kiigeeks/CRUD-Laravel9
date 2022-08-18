@extends('layouts.main')


@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->judul }}</h1>
                <p>
                    By <a href="/post?author={{ $post->author->username }}"
                        class="text-decoration-none">{{ $post->author->name }}</a> in <a
                        href="/post?category={{ $post->category->slug }}"
                        class="text-decoration-none">{{ $post->category->nama }}</a>,
                    <small class="text-muted">
                        {{ $post->created_at->diffForHumans() }}
                    </small>
                </p>
                @if ($post->thumb)
                    <div style="max-height: 300px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->thumb) }}" class="img-fluid"
                            alt="{{ $post->category->nama }}">
                    </div>
                @else
                    <img src="https://source.unsplash.com/random/1200x400?{{ $post->category->nama }}" class="img-fluid"
                        alt="{{ $post->category->nama }}">
                @endif

                <article class="my-3 fs-5">
                    {!! $post->desc !!}
                </article>

                <a href="{{ route('post') }}" class="mt-3 btn btn-danger"><i class="bi bi-arrow-left"></i> &nbsp; Back</a>
            </div>
        </div>
    </div>
@endsection
