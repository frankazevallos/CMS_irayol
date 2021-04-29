@extends('layouts.frontend')
@push('title', $search)
@section('content')
<div class="container pt-5 pb-5">
    <h1 class="text-center">{{$search}}</h1>
    <form class="form-inline" action="{{route('blog.search')}}" method="get">
        <input class="form-control mr-sm-2" type="text" name="search" id="search" required>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">{{__('global.search')}}</button>
    </form>
    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($blogs as $blog)
        <div class="col mt-4">
            <div class="card h-100">
                <a href="{{route('blog.show', $blog->slug)}}"><img
                        src="{{$blog->main_image ? $blog->main_image : asset('manager/images/placeholder-image.jpg')}}"
                        class="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="{{route('blog.show', $blog->slug)}}">{{$blog->title}}</a></h5>
                    @if (strlen($blog->content) > 150)
                    {{substr($blog->content, 0, 150, ) . '...'}}
                    @else
                    {{$blog->content}}
                    @endif
                </div>
                <div class="card-footer">
                    <i class="fas fa-user-circle"></i> {{__('global.posted_by')}} <a
                        href="{{route('users.show', $blog->user->id)}}">{{ $blog->user->name}}</a><br>
                    <i class="fas fa-clock"></i> {{$blog->created_at->format('Y-m-d')}}<br>
                    @if (count($blog->categories) > 0)
                    <i class="fas fa-tag"></i>
                    @foreach ($blog->categories as $category)
                    <a href="{{ route('site.category', $category->slug) }}">{{$category->name}}</a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-12 mt-4">
            {{$blogs->links()}}
        </div>
    </div>
</div>
@endsection
