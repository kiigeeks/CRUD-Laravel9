@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Halaman Post</h1>
    </div>

    @if (session()->has('postAdd'))
        <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
            {{ session('postAdd') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('postErr'))
        <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
            {{ session('postErr') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/posts/create" class="btn btn-success mb-3"><span data-feather="plus"
                class="align-text-bottom"></span> New Post</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->judul }}</td>
                        <td>{{ $post->category->nama }}</td>
                        <td>{{ $post->created_at->format('d-M-Y H:i') }}</td>
                        <td>
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"
                                    class="align-text-bottom"></span></a>
                            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit" class="align-text-bottom"></span></a>
                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="badge bg-danger border-0" onclick="confirm('Yakin hapus data?')"><span
                                        data-feather="trash" class="align-text-bottom"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
