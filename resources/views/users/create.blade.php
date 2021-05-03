@extends('layouts.app')
@push('title', __('global.users.title'))
@section('content')
    <div class="card mt-3">
        <div class="card-header clearfix">
            <span class="float-left">
                {{__('global.users.title')}}
            </span>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('users.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
            </div>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="create_users_form" name="create_users_form" class="form-horizontal">
                @csrf
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="control-label">{{ __('Name') }}</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ old('name')}}" minlength="1" maxlength="255" required="true" >
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                    <input class="form-control" name="email" type="email" id="email" value="{{ old('email') }}" minlength="1" maxlength="255" required="true">
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="control-label">{{ __('Password') }}</label>
                    <input class="form-control" name="password" type="password" id="password" minlength="5" maxlength="50" required="true">
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="control-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <label class="control-label" for="menu">Roles</label>
                    <select multiple="" class="form-control select2" id="roles" name="roles[]">
                        @foreach ($roles as $key => $role)
                            <option value="{{ $role }}" {{ old('roles[]') }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{__('global.add')}}">
                </div>

            </form>

        </div>
    </div>

@endsection


