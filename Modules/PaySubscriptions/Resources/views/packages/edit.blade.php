@extends('layouts.app')
@push('title', __('paysubscriptions::global.pay_subscriptions')) 
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{ __('paysubscriptions::global.package') . ' '. $package->name}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <form method="POST" action="{!! route('packages.destroy', $package->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="btn-group-sm" role="group">
                        <a href="{{ route('paysubscriptions.index') }}" class="btn btn-primary" title="{{__('paysubscriptions::global.return_back')}}">
                            <i class="fa fa-undo" aria-hidden="true"></i> {{__('paysubscriptions::global.return_back')}}
                        </a>
    
                        <a href="{{ route('packages.create') }}" class="btn btn-success" title="{{__('paysubscriptions::global.create')}}">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('paysubscriptions::global.create')}}
                        </a>
    
                        <button type="submit" class="btn btn-danger" title="{{__('paysubscriptions::global.delete')}}" onclick="return confirm(&quot;{{__('paysubscriptions::global.confirm_delete')}}&quot;)">
                            <i class="fas fa-trash"></i> {{__('paysubscriptions::global.delete')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('packages.update', $package->id) }}" id="edit_package_form" name="edit_package_form" accept-charset="UTF-8" class="form-horizontal">
            @method('PUT')
            @csrf
            @include ('paysubscriptions::packages.form', ['package' => $package,])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('modules/paysubscriptions/js/main.js')}}"></script>
@endpush