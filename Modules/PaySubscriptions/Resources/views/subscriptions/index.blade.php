@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{route('paysubscriptions.index')}}" class="list-group-item list-group-item-action ">{{__('paysubscriptions::global.packages')}}</a>
            <a href="{{route('subscriptions.index')}}" class="list-group-item list-group-item-action active">{{__('paysubscriptions::global.subscriptions')}}</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    {{__('paysubscriptions::global.subscriptions')}}
                </div>
                <div class="btn-group-sm float-right" role="group">
                    <a href="{{ route('subscriptions.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}</a>
                </div>
            </div>
            <div class="card-body p-0">
                @if (count($subscriptions) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{__('paysubscriptions::global.title')}}</th>
                                <th>{{__('paysubscriptions::global.interval.title')}}</th>
                                <th>{{__('paysubscriptions::global.interval.interval_count')}}</th>
                                <th>{{__('paysubscriptions::global.trial_days')}}</th>
                                <th>{{__('paysubscriptions::global.price')}}</th>
                                <th>{{__('paysubscriptions::global.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-warning m-3" role="alert">{{__('paysubscriptions::global.did_not_find_any_record')}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection