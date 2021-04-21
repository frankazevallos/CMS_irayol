@extends('layouts.app')
@push('title', __('global.settings'))
@section('content')
    <div class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-8">
                    {{__('global.settings')}}
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped data-table-setting">
                    <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>{{__('global.update_at')}}</th>
                            <th>{{__('global.action')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('settings.edit')
@endsection
