@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $headerPage }}</h1>

    @forelse ($jurnalis as $item)
        <div class="shadow-lg p-3 mb-2 bg-body rounded"><a href="/post?author={{ $item->username }}" class="text-decoration-none text-dark">{{ $item->name }}</a></div>
    @empty
        <div class="shadow-lg p-3 mb-5 bg-body rounded">No Jurnalist Found</div>
    @endforelse
@endsection
