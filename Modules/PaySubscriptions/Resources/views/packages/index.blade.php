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
                        {{-- @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ __('paysubscriptions::global.interval.'.$package->interval) }}</td>
                                <td>{{ $package->interval_count }}</td>
                                <td>{{ $package->trial_days }}</td>
                                <td>{{ '$' . number_format($package->price, 2)  }}</td>
                                <td>
                                    <form method="POST" action="{{ route('packages.destroy', $package->id) }}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group-xs float-right" role="group">
                                            <a href="{{ route('packages.show', $package->id) }}" class="btn btn-info btn-sm" title="{{__('paysubscriptions::global.view')}}">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-primary btn-sm" title="{{__('paysubscriptions::global.edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot; {{__('paysubscriptions::global.confirm_delete')}} &quot;)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </table>
                @else
                    <div class="alert alert-warning m-3" role="alert">{{__('paysubscriptions::global.did_not_find_any_record')}}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush

