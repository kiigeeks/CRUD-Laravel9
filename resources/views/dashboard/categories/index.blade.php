@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Halaman Category</h1>
    </div>

    @if (session()->has('categoryAdd'))
        <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
            {{ session('categoryAdd') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive col-md-6">
        <a href="/dashboard/categories/create" class="btn btn-success mb-3"><span data-feather="plus"
                class="align-text-bottom"></span> New Category</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cat->nama }}</td>
                        <td>
                            <a href="/dashboard/categories/{{ $cat->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit" class="align-text-bottom"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
