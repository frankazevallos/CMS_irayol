@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{route('paysubscriptions.index')}}" class="list-group-item list-group-item-action ">{{__('paysubscriptions::global.packages')}}</a>
            <a href="{{route('subscription.index')}}" class="list-group-item list-group-item-action active">{{__('paysubscriptions::global.subscriptions')}}</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    {{__('paysubscriptions::global.subscriptions')}}
                </div>
                <div class="btn-group-sm float-right" role="group">
                    <a href="{{ route('subscription.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}</a>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection