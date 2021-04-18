@extends('layouts.app')
@push('title', __('global.categories')) 
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{ !empty($category->name) ? $category->name : __('global.categories') }}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('categories.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
                <a href="{{ route('categories.create') }}" class="btn btn-success" title="{{__('global.create')}}">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('categories.update', $category->id) }}" id="edit_category_form" name="edit_category_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('categories.form', ['category' => $category,])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{__('global.update')}}">
                </div>
            </form>
        </div>
    </div>
@endsection