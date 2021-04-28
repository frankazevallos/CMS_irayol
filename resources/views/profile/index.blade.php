@extends('layouts.app')
@push('title', __('global.profile'))
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center mb-3">
                    <img class="img-fluid rounded" src="{{$user->profile ? $user->profile->avatar : asset('manager/images/userProfile.jpeg')}}">
                </div>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                </a>

                <ul class="list-group list-group-unbordered mb-3 mt-3">
                    <li class="list-group-item">
                        <b>{{ Auth::user()->name }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{ Auth::user()->username }}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{ Auth::user()->email }}</b>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="nav flex-column nav-pills p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-personal_data-tab" data-toggle="pill" href="#v-pills-personal_data" role="tab" aria-controls="v-pills-personal_data" aria-selected="true">{{__('global.personal_data')}}</a>
                <a class="nav-link" id="v-pills-social_networks-tab" data-toggle="pill" href="#v-pills-social_networks" role="tab" aria-controls="v-pills-social_networks" aria-selected="false">{{__('global.social_networks')}}</a>
                <a class="nav-link" id="v-pills-address-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false">{{__('global.address')}}</a>
                <a class="nav-link" id="v-pills-change_password-tab" data-toggle="pill" href="#v-pills-change_password" role="tab" aria-controls="v-pills-change_password" aria-selected="false">{{__('global.change_password')}}</a>
                <a class="nav-link" id="v-pills-delete_account-tab" data-toggle="pill" href="#v-pills-delete_account" role="tab" aria-controls="v-pills-delete_account" aria-selected="false">{{__('global.delete_account')}}</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-personal_data" role="tabpanel" aria-labelledby="v-pills-personal_data-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('global.personal_data')}}</h3>
                    </div>
                    <div class="card-body">
                        <strong>{{ __('global.mobile') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->mobile : '' }}</p>
                        <hr>

                        <strong>{{__('global.gender')}}</strong>
                        <p class="text-muted">{{ $user->profile ? __('global.' . $user->profile->gender) : '' }}</p>
                        <hr>

                        <strong>{{ __('global.date_of_birth') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->date_of_birth : '' }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-social_networks" role="tabpanel" aria-labelledby="v-pills-social_networks-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('global.social_networks')}}</h3>
                    </div>
                    <div class="card-body">
                        <strong>{{ __('global.url_website') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_website : '' }}</p>
                        <hr>

                        <strong>{{ __('global.url_facebook') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_facebook : '' }}</p>
                        <hr>

                        <strong>{{ __('global.url_twitter') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_twitter : '' }}</p>
                        <hr>

                        <strong>{{ __('global.url_instagram') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_instagram : '' }}</p>
                        <hr>

                        <strong>{{ __('global.url_linkedin') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_linkedin : '' }}</p>
                        <hr>

                        <strong>{{ __('global.url_github') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->url_github : '' }}</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('global.address')}}</h3>
                    </div>
                    <div class="card-body">
                        <strong>{{ __('global.country') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->country : '' }}</p>
                        <hr>

                        <strong>{{__('global.state')}}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->state : '' }}</p>
                        <hr>

                        <strong>{{ __('global.city') }}</strong>
                        <p class="text-muted">{{ $user->profile ? $user->profile->city : '' }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-change_password" role="tabpanel" aria-labelledby="v-pills-change_password-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('global.change_password')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('change.password')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{__('global.current_password')}}</label>
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" required>
                            </div>

                            <div class="form-group">
                                <label for="new_password" class="col-form-label text-md-right">{{__('global.new_password')}}</label>
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" required>
                            </div>

                            <div class="form-group">
                                <label for="new_confirm_password" class="col-form-label text-md-right">{{__('global.new_confirm_password')}}</label>
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" required>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">{{__('global.update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-delete_account" role="tabpanel" aria-labelledby="v-pills-delete_account-tab">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('global.delete_account')}}</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="{{route('profile.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm(&quot; {{__('global.confirm_delete')}} &quot;);"><i class="fas fa-trash"></i> {{__('global.delete')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
