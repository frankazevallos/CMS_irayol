@extends('layouts.frontend')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="container my-3">
    <div class="row row-cols-1 row-cols-md-3 text-center">
        @foreach ($packages as $package)
        <div class="col mt-3">
            <div class="card h-100 shadow">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">{{$package->name}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{ '$' . number_format($package->price, 2) }}<small class="text-muted fw-light">/{{ __('paysubscriptions::global.interval.'.$package->interval) }}</small></h1>
                    <p>
                        {!! $package->description !!}
                    </p>
                </div>
                <div class="card-footer">
                    <form action="{{route('pay.subscription', $package->id)}}" method="post">
                        @csrf
                        <button type="submit" class="w-100 btn btn-lg btn-outline-primary">{{__('paysubscriptions::global.become_premium')}}</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection