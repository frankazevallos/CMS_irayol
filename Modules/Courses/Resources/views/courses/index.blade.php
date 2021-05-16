@extends('layouts.app')
@push('title', __('courses::global.courses'))
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{__('courses::global.courses')}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('courses.create') }}" class="btn btn-success" title="Create New Category"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('courses::global.new')}}</a>
                <a class="btn btn-info btn-sm" href="{{route('course.all')}}" target="_blank"><i class="fas fa-globe-americas"></i> {{__('courses::global.view_all_courses')}}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover data-table-courses">
                <thead>
                    <tr>
                        <th>{{__('global.title')}}</th>
                        <th>{{__('global.author')}}</th>
                        <th>{{__('global.categories')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('modules/courses/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('modules/courses/js/main.js')}}"></script>
@endpush