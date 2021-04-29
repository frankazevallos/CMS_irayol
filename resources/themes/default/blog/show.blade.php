@extends('layouts.frontend')

@push('title', $blog->title )
@push('titleseo', $blog->titleseo )
@push('descseo', $blog->descseo )
@push('keywordseo', $blog->keywordseo )
@push('author',  $blog->user->name )

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

    @can('blog.edit')
        <div class="floatBtn">
            <div class="dropdown">
                <a href="#" class="btn btn-secondary" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('blogs.create') }}" class="dropdown-item" title="{{__('global.create')}}">
                        <i class="fa fa-plus-circle"></i> {{__('global.create')}}
                    </a>
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="dropdown-item" title="{{__('global.edit')}}">
                        <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                    </a>
                </div>
            </div>
        </div>
    @endcan
</div>
@endsection
