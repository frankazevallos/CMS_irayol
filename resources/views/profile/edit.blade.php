@extends('layouts.app')
@push('title', __('global.profile'))
@section('content')
    <div class="card mt-3">
        <div class="card-header clearfix">
            <div class="float-left">
                {{__('global.profile')}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('profile.index') }}" class="btn btn-primary" title="Show All Users">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('profile.update', $user->id) }}" id="edit_users_form" name="edit_users_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-weight-bold text-center">{{__('global.personal_data')}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label for="avatar">{{__('global.avatar')}}</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
                            {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label for="username" class="control-label">{{ __('Username') }}</label>
                            <input class="form-control" name="username" type="text" id="username" value="{{ old('username', optional($user)->username) }}" minlength="1" maxlength="255" required>
                            {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="control-label">{{ __('Name') }}</label>
                            <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                            <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required>
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                            <label for="mobile" class="control-label">{{ __('global.mobile') }}</label>
                            <input class="form-control" name="mobile" type="tel" id="mobile" value="{{ old('mobile', optional($user->profile)->mobile) }}" >
                            {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                            <label for="gender">{{__('global.gender')}}</label>
                            <select class="form-control select2" name="gender" id="gender" >
                                @foreach ($data = array('male' => __('global.male'), 'female' => __('global.female'), 'other' => __('global.other')); as $key => $gender)
                                    <option value="{{$key}}" {{ $user->profile->gender == $key ? 'selected' : '' }}>{{$gender}}</option>
                                @endforeach
                            </select>
                            {{ $errors->first('gender', '<p class="help-block">:message</p>') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
                            <label for="date_of_birth" class="control-label">{{ __('global.date_of_birth') }}</label>
                            <input class="form-control datetimepicker datetimepicker-input" name="date_of_birth" type="text" id="date_of_birth" value="{{ old('date_of_birth', optional($user->profile)->date_of_birth) }}" data-toggle="datetimepicker" data-target=".date_of_birth">
                            {!! $errors->first('date_of_birth', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-weight-bold text-center">{{__('global.social_networks')}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_website') ? 'has-error' : '' }}">
                            <label for="url_website" class="control-label">{{ __('global.url_website') }}</label>
                            <input class="form-control" name="url_website" type="text" id="url_website" value="{{ old('url_website', optional($user->profile)->url_website) }}">
                            {!! $errors->first('url_website', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_facebook') ? 'has-error' : '' }}">
                            <label for="url_facebook" class="control-label">{{ __('global.url_facebook') }}</label>
                            <input class="form-control" name="url_facebook" type="text" id="url_facebook" value="{{ old('url_facebook', optional($user->profile)->url_facebook) }}">
                            {!! $errors->first('url_facebook', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_twitter') ? 'has-error' : '' }}">
                            <label for="url_twitter" class="control-label">{{ __('global.url_twitter') }}</label>
                            <input class="form-control" name="url_twitter" type="text" id="url_twitter" value="{{ old('url_twitter', optional($user->profile)->url_twitter) }}">
                            {!! $errors->first('url_twitter', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_instagram') ? 'has-error' : '' }}">
                            <label for="url_instagram" class="control-label">{{ __('global.url_instagram') }}</label>
                            <input class="form-control" name="url_instagram" type="text" id="url_instagram" value="{{ old('url_instagram', optional($user->profile)->url_instagram) }}">
                            {!! $errors->first('url_instagram', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_linkedin') ? 'has-error' : '' }}">
                            <label for="url_linkedin" class="control-label">{{ __('global.url_linkedin') }}</label>
                            <input class="form-control" name="url_linkedin" type="text" id="url_linkedin" value="{{ old('url_linkedin', optional($user->profile)->url_linkedin) }}">
                            {!! $errors->first('url_linkedin', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('url_github') ? 'has-error' : '' }}">
                            <label for="url_github" class="control-label">{{ __('global.url_github') }}</label>
                            <input class="form-control" name="url_github" type="text" id="url_github" value="{{ old('url_github', optional($user->profile)->url_github) }}">
                            {!! $errors->first('url_github', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-weight-bold text-center">{{__('global.address')}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                            <label for="country" class="control-label">{{ __('global.country') }}</label>
                            <input class="form-control" name="country" type="text" id="country" value="{{ old('country', optional($user->profile)->country) }}">
                            {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state" class="control-label">{{ __('global.state') }}</label>
                            <input class="form-control" name="state" type="text" id="state" value="{{ old('state', optional($user->profile)->state) }}">
                            {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city" class="control-label">{{ __('global.city') }}</label>
                            <input class="form-control" name="city" type="text" id="city" value="{{ old('city', optional($user->profile)->city) }}">
                            {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-weight-bold text-center">{{__('global.new_password')}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="control-label">{{ __('Password') }}</label>
                            <input class="form-control" name="password" type="password" id="password" minlength="5" maxlength="50">
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="control-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark">
            <div class="card-footer">
                <input class="btn btn-primary float-right" type="submit" value="{{__('global.update')}}">
            </div>
        </div>
    </form>
@endsection
