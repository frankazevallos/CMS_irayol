@extends('layouts.app')
@push('title', __('global.categories')) 
@section('content')
    <div class="card">
        <div class="card-header clearfix">        
            <span class="float-left">
                {{__('global.create_new') . ' ' . strtolower(__('global.category'))}}
            </span>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('categories.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}" accept-charset="UTF-8" id="create_category_form" name="create_category_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('categories.form', ['category' => null,])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{__('global.save')}}">
                </div>
            </form>
        </div>
    </div>
@endsection


