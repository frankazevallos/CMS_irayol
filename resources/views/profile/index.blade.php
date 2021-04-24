@extends('layouts.app')
@push('title', __('global.profile'))
@section('content')

<div class="card mt-3">

    <div class="card-header clearfix">
        <span class="float-left">
            {{ $user->name }}
        </span>
        <div class="float-right">
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary" title="Edit Users">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $user->name }}</dd>
            <dt>Email</dt>
            <dd>{{ $user->email }}</dd>

        </dl>
    </div>
</div>
@endsection
