@extends('layouts.app')
@push('title', __('global.menus'))
@section('content')
    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                <div class="float-left">
                    {{__('global.menus')}}
                </div>
            </div>
            <div class="tn-group-sm float-right">
                <div class="btn-group-sm float-right" role="group">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMediaModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped data-table-menu">
                    <thead>
                        <tr>
                            <th>{{__('global.title')}}</th>
                            <th>{{__('global.created_at')}}</th>
                            <th>{{__('global.main_menu')}}</th>
                            <th>{{__('global.action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('menu.create')
    @include('menu.edit')
@endsection
