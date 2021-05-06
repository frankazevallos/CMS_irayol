@extends('layouts.app')
@push('title', __('courses::global.section'))
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{$course->title}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('courses.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}"><i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}</a>
                <a href="javascript:void(0)" class="btn btn-success" title="{{__('courses::global.create')}}" id="new-section"><i class="fas fa-folder" aria-hidden="true"></i> {{__('courses::global.new_section')}}</a>
                <a href="javascript:void(0)" class="btn btn-success" title="{{__('courses::global.create')}}" id="new-class"><i class="fas fa-video"></i> {{__('courses::global.new_class')}}</a>
            </div>
        </div>
    </div>

    <div id="section-loop">
        @foreach ($sections as $section)
            <div class="card" id="card_section_{{ $section->id }}">
                <div class="card-header" id="section_id_{{ $section->id }}">
                    <h3 class="card-title">{{$section->title}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <a href="javascript:void(0)" id="edit-section" data-id="{{ $section->id }}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" id="delete-section" data-id="{{ $section->id }}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="list-group sortabe" id="class_loop_{{ $section->id }}">
                        @foreach ($section->classes as $class)
                            <div class="list-group-item" data-id="{{ $class->id }}" id="list_class_{{ $class->id }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-arrows-alt handle mr-3"></i> {{$class->title}}
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" id="edit-class" data-id="{{ $class->id }}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" id="delete-class" data-id="{{ $class->id }}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add classes and section modal -->
    @include('courses::courses.partials.section-modal')
    @include('courses::courses.partials.class-modal')

@endsection

@push('js')
    <script src="{{asset('modules/courses/js/Sortable.min.js')}}"></script>
    <script src="{{asset('modules/courses/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('modules/courses/js/jquery-sortable.js')}}"></script>
    <script src="{{asset('modules/courses/js/main.js')}}"></script>
    <script src="{{asset('modules/courses/js/sections.js')}}"></script>
    <script src="{{asset('modules/courses/js/classes.js')}}"></script>
@endpush
