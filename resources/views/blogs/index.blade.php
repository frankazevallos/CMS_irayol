@extends('layouts.app')
@push('title', __('global.blogs'))
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                {{__('global.list_blogs')}}
            </div>
            <div class="col-md-6">
                <div class="btn-group-sm float-right" role="group">
                    <a class="btn btn-success btn-sm" href="{{ route('blogs.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                    <a class="btn btn-info btn-sm" href="{{route('blog.index')}}" target="_blank"><i class="fas fa-globe-americas"></i> {{__('global.view_all_entries')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-hover data-table-blog">
            <thead>
                <tr>
                    <th>{{__('global.title')}}</th>
                    <th>{{__('global.author')}}</th>
                    <th>{{__('global.categories')}}</th>
                    <th>{{__('global.visibility')}}</th>
                    <th>{{__('global.update_at')}}</th>
                    <th>{{__('global.action')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
