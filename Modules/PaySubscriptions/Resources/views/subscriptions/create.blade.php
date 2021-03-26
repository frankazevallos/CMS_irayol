@extends('layouts.app')

@push('title', __('paysubscriptions::global.pay_subscriptions'))

@section('content')
<div class="card">
    <div class="card-header clearfix">        
        <span class="float-left">
            {{__('paysubscriptions::global.new')}}
        </span>
        <div class="btn-group-sm float-right" role="group">
            <a href="{{ route('subscriptions.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                <i class="fa fa-undo" aria-hidden="true"></i> {{__('paysubscriptions::global.return_back')}}
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('subscriptions.store') }}" accept-charset="UTF-8" id="create_package_form" name="create_package_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('paysubscriptions::subscriptions.form', ['subscription' => null,])
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="{{__('paysubscriptions::global.save')}}">
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush