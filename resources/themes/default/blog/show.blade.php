@extends('layouts.frontend')

@section('title') {{ $blog->title }} @endsection
@section('titleseo') {{ $blog->titleseo }} @endsection
@section('descseo') {{ $blog->descseo }} @endsection
@section('keywordseo') {{ $blog->keywordseo }} @endsection

@section('content')
<div class="container p-5">
    <p class="text-center">
        {{ $blog->user->name }}<br>
        {{ $blog->created_at->format('Y-m-d') }}
    </p>

    <h2 class="font-weight-bold text-center">{{ $blog->title }}</h2>

    @if ($blog->main_image)
        <p class="mt-3 mb-3">
            <img src="{{$blog->main_image ? $blog->main_image : asset('manager/images/placeholder-image.jpg')}}" class="img-fluid rounded">
        </p>
    @endif

    {!! $blog->content !!}
</div>
@endsection
