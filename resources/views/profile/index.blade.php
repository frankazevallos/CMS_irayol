@extends('layouts.app')
@push('title', __('global.profile'))
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center mb-3">
                    <img class="img-fluid rounded" src="{{$user->profile->avatar}}" alt="User profile picture">
                </div>

                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-block">
                    <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                </a>
                <ul class="list-group list-group-unbordered mb-3 mt-3">
                    <li class="list-group-item">
                        <b>{{ $user->name }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{ $user->username }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{ $user->email }}</b>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{__('global.personal_data')}}</h3>
            </div>
            <div class="card-body">
                <strong>{{ __('global.mobile') }}</strong>
                <p class="text-muted">{{ $user->profile->mobile }}</p>
                <hr>

                <strong>{{__('global.gender')}}</strong>
                <p class="text-muted">{{ __('global.' . $user->profile->gender) }}</p>
                <hr>

                <strong>{{ __('global.date_of_birth') }}</strong>
                <p class="text-muted">{{ $user->profile->date_of_birth }}</p>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{__('global.social_networks')}}</h3>
            </div>
            <div class="card-body">
                <strong>{{ __('global.url_website') }}</strong>
                <p class="text-muted">{{ $user->profile->url_website }}</p>
                <hr>

                <strong>{{ __('global.url_facebook') }}</strong>
                <p class="text-muted">{{ $user->profile->url_facebook }}</p>
                <hr>

                <strong>{{ __('global.url_twitter') }}</strong>
                <p class="text-muted">{{ $user->profile->url_twitter }}</p>
                <hr>

                <strong>{{ __('global.url_instagram') }}</strong>
                <p class="text-muted">{{ $user->profile->url_instagram }}</p>
                <hr>

                <strong>{{ __('global.url_linkedin') }}</strong>
                <p class="text-muted">{{ $user->profile->url_linkedin }}</p>
                <hr>

                <strong>{{ __('global.url_github') }}</strong>
                <p class="text-muted">{{ $user->profile->url_github }}</p>
                <hr>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{__('global.address')}}</h3>
            </div>
            <div class="card-body">
                <strong>{{ __('global.country') }}</strong>
                <p class="text-muted">{{ $user->profile->country }}</p>
                <hr>

                <strong>{{__('global.state')}}</strong>
                <p class="text-muted">{{ $user->profile->state }}</p>
                <hr>

                <strong>{{ __('global.city') }}</strong>
                <p class="text-muted">{{ $user->profile->city }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
