@extends('layouts.app')
@push('title', __('global.users.title'))
@section('content')

    <div class="card mt-3">
        <div class="card-header clearfix">
            <div class="float-left">
                {{ !empty($users->name) ? $users->name : __('global.users.title') }}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('users.index') }}" class="btn btn-primary" title="Show All Users">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $users->id) }}" id="edit_users_form" name="edit_users_form" accept-charset="UTF-8" class="form-horizontal">
                @csrf
                @method('PUT')
                @include ('users.form', ['users' => $users, 'roles' => $roles])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{__('global.update')}}">
                </div>
            </form>
        </div>
    </div>

@endsection
