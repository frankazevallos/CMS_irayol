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
                    {{__('paysubscriptions::global.subscriptions')}}
                </div>
                <div class="btn-group-sm float-right" role="group">
                    <button type="button" class="btn btn-secondary" id="reportrange">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </button>
                    <a href="{{ route('subscriptions.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="subscriptions">{{$subscriptions}}</h3>
                                <p>{{__('paysubscriptions::global.subscriptions')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 class="total_subscripciones">{{'$' . number_format($total_subscripciones, 2)}}</h3>
                                <p>{{__('paysubscriptions::global.total_subscripciones')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body"> 
                @if ($subscriptions > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table-subscription">
                        <thead>
                            <tr>
                                <th>{{__('paysubscriptions::global.name')}}</th>
                                <th>{{__('paysubscriptions::global.package')}}</th>
                                <th>{{__('paysubscriptions::global.status')}}</th>
                                <th>{{__('paysubscriptions::global.start_date')}}</th>
                                <th>{{__('paysubscriptions::global.trial_end_date')}}</th>
                                <th>{{__('paysubscriptions::global.end_date')}}</th>
                                <th>{{__('paysubscriptions::global.action')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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