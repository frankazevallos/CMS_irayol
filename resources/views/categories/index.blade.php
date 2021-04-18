@extends('layouts.app')
@push('title', __('global.categories')) 
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{__('global.categories')}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('categories.create') }}" class="btn btn-success" title="Create New Category"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped data-table-category">
                <thead>
                    <tr>
                        <th>{{__('global.title')}}</th>
                        <th>{{__('global.status')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                </thead>
            </table>
        </div>  
    </div>
@endsection