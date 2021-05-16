@extends('layouts.frontend')
@push('title', __('courses::global.courses'))
@section('content')
<div class="container my-5">
    @if (count($courses) > 0)        
        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($courses as $course)
            <div class="col mt-4">
                <div class="card h-100">
                    <a href="{{route('course.view', $course->slug)}}"><img src="{{$course->image ?: asset('manager/images/placeholder-image.jpg')}}" class="img-fluid"></a>
                    <div class="card-body">
                        <a href="{{route('course.view', $course->slug)}}">
                            <h5 class="card-title">{{$course->title}}</h5>
                        </a>
                        <p class="card-text">
                            @if (strlen($course->description) > 150)
                            {{substr($course->description, 0, 150, ) . '...'}}
                            @else
                            {{$course->description}}
                            @endif
                        </p>
                        
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-user-circle"></i> {{__('global.posted_by')}} <a
                            href="{{route('users.show', $course->user->id)}}">{{ $course->user->name}}</a><br>
                        <i class="fas fa-clock"></i> {{$course->created_at->format('Y-m-d')}}<br>
                        @if (count($course->categories) > 0)
                        <i class="fas fa-tag"></i>
                        @foreach ($course->categories as $category)
                        <a href="{{ route('site.category', $category->slug) }}">{{$category->name}}</a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12 mt-4">
                {{$courses->links()}}
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <h4 class="mt-2">{{__('global.no_results')}}</h4>
        </div>
    @endif
</div>
@endsection