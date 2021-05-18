@extends('layouts.frontend')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
    <div class="container my-5">
        <div class="text-center">
            <h1 class="display-4">{{__('paysubscriptions::global.invest_in_yourself')}}</h1>
            <p class="lead">{{__('paysubscriptions::global.with_any_subscription')}}</p>
        </div>
        <div class="row row-cols-1 row-cols-md-3 text-center">
            @foreach ($packages as $package)
            <div class="col mt-3">
                <div class="card h-100 shadow">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">{{$package->name}}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ '$' . number_format($package->price, 2) }}<small
                            class="text-muted fw-light">/{{ __('paysubscriptions::global.interval.'.$package->interval) }}</small>
                        </h1>
                        <p>
                            {!! $package->description !!}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('subscription.index', $package->id)}}" class="w-100 btn btn-lg btn-outline-primary">{{__('paysubscriptions::global.become_premium')}} <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 mt-4">
            {{$packages->links()}}
        </div>
    </div>
@endsection