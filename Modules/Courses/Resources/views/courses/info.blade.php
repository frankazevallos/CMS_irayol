@extends('layouts.frontend')

@section('content')
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{$course->image}}" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold text-center">{{$course->title}}</h2>
                            <p class="card-text">{{$course->description}}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($sections as $section)
                <div class="accordion mt-3" id="accordion_{{$section->id}}">
                    <div class="card">
                        <div class="card-header" id="heading_{{$section->id}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$section->id}}" aria-expanded="true" aria-controls="collapse_{{$section->id}}">
                                    {{$section->title}}
                                </button>
                            </h2>
                        </div>
    
                        <div id="collapse_{{$section->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_{{$section->id}}">
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($section->classes as $class)
                                        <a href="{{route('course.play', [$course->slug, $class->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{$class->title}}</h5>
                                                <p class="text-success"><i class="fas fa-play-circle"></i> {{__('courses::global.play')}}</p>
                                            </div>

                                            <div class="d-flex w-100 justify-content-between">
                                                <p class="mb-1">{{__('courses::global.duration'). ': ' . $class->duration}}</p>
                                                <p>
                                                    <small class="text-info"><i class="fas fa-{{$class->access == 'free' ? 'unlock' : 'lock'}}" ></i> {{  __('courses::global.' . $class->access) }} </small>
                                                    <small class="ml-2"><i class="fas fa-{{ $class->checkUserViewed() ? 'eye' : 'eye-slash' }}"></i> {{ $class->checkUserViewed() ? __('courses::global.viewed') : __('courses::global.no_viewed') }}</small>
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
