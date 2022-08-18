@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $headerPage }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/post">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" value="{{ request('search') }}"
                        name="search" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3 mb-4">
            @if ($posts[0]->thumb)
                <div style="max-height: 300px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $posts[0]->thumb) }}" class="card-img-top" alt="Konten Update">
                </div>
            @else
                <img src="https://source.unsplash.com/random/1200x400?{{ $posts[0]->category->nama }}"
                    class="card-img-top" alt="Konten Update">
            @endif
            <div class="card-body text-center">
                <h3 class="card-title"><a href="/post/{{ $posts[0]->slug }}"
                        class="text-decoration-none text-dark">{{ $posts[0]->judul }}</a></h3>
                <p>
                    <small class="text-muted">
                        <a href="/post?category={{ $posts[0]->category->slug }}"
                        class="text-decoration-none"><b><i>{{ $posts[0]->category->nama }}</i></b></a>
                        By <a href="/post?author={{ $posts[0]->author->username }}"
                            class="text-decoration-none">{{ $posts[0]->author->name }}</a>,
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{!! collect(explode('. ', $posts[0]->desc))->take(2)->implode('. ') !!}</p>
                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More<a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card" style="height: 33rem;">
                            {{-- <div class="position-absolute px-2 py-2 text-white" style="background-color: rgba(0,0,0,0.7)">
                                <a href="/post?category={{ $post->category->slug }}"
                                    class="text-decoration-none text-white">{{ $post->category->nama }}</a>
                            </div> --}}
                            @if ($post->thumb)
                                <div style="max-height: 250px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $post->thumb) }}" class="card-img-top"
                                        alt="Konten Lama">
                                </div>
                            @else
                                <img src="https://source.unsplash.com/random/600x400?{{ $post->category->nama }}"
                                    class="card-img-top" alt="Konten Lama">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title"><a href="/post/{{ $post->slug }}"
                                        class="text-decoration-none text-dark">{{ $post->judul }}</a>
                                </h5>

                                <p>
                                    <small class="text-muted">
                                        <a href="/post?category={{ $post->category->slug }}" class="text-decoration-none"><b><i>{{ $post->category->nama }}</i></b></a>
                                        By <a href="/post?author={{ $post->author->username }}"
                                            class="text-decoration-none">{{ $post->author->name }}</a>,
                                            {{ $posts[0]->created_at->diffForHumans() }}
                                    </small>
                                </p>

                                <p class="card-text">
                                    {{-- ambil 1 kalimat diakhiri tanda .  --}}
                                    {!! collect(explode('. ', $post->desc))->take(1)->implode('. ') !!}
                                </p>
                                <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No Posts Found</p>
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
@endsection
