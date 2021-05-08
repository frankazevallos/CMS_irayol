@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions'))
@section('content')
<div class="row">
    <div class="col-md-3">
        @include('paysubscriptions::partials.navbar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

            </div>
        </div>

    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush