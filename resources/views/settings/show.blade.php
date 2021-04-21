@extends('layouts.app')
@push('title', __('global.settings'))
@section('content')

<div class="card mt-3">
    <div class="card-header clearfix">

        <span class="float-left">
            {{ isset($setting->label) ? $setting->label : __('global.settings') }}
        </span>

        <div class="float-right">


                <div class="btn-group-sm" role="group">
                    <a href="{{ route('setting.index') }}" class="btn btn-primary" title="Show All Setting">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </a>

                    <a href="{{ route('setting.edit', $setting->id ) }}" class="btn btn-primary" title="Edit Setting">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>


        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Key</dt>
            <dd>{{ $setting->key }}</dd>
            <dt>Value</dt>
            <dd>{{ $setting->value }}</dd>
        </dl>

    </div>
</div>

@endsection
