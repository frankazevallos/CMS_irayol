@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3">
        @include('paysubscriptions::partials.navbar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    {{__('paysubscriptions::global.packages')}}
                </div>
                <div class="btn-group-sm float-right" role="group">
                    <a href="{{ route('packages.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}</a>
                    <a href="{{ route('all.packages') }}" class="btn btn-secondary" target="_blank" title="{{__('paysubscriptions::global.view_all_packages')}}"><i class="fas fa-globe-americas"></i> {{__('paysubscriptions::global.view_all_packages')}}</a>
                </div>
            </div>
            <div class="card-body">
                @if(count($packages) > 0)
                    <table class="table table-hover data-table">
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
                    </table>
                @else
                    <div class="alert alert-warning my-1" role="alert">{{__('paysubscriptions::global.did_not_find_any_record')}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush

