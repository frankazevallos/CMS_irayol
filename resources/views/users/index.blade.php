@extends('layouts.app')
@push('title', __('global.users.title'))
@section('content')

    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                {{__('global.users.title')}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('users.create') }}" class="btn btn-success" title="{{__('global.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>

        <div class="card-body ">
            <table class="table table-striped data-table-users">
                <thead>
                    <tr>
                        <th>{{__('global.email')}}</th>
                        <th>{{__('global.email_verified_at')}}</th>
                        <th>{{__('global.users.fields.name')}}</th>
                        <th>{{__('global.roles.title')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
