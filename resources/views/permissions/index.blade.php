@extends('layouts.app')
@push('title', 'Permissions')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    {{__('global.permissions.title')}}
                </div>
                <div class="col-md-2">
                    <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($permissions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>{{__('global.permissions.fields.name')}}</th>
                        <th>{{__('global.permissions.fields.options')}}</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group btn-group-xs float-right" role="group">
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="{{__('global.delete')}}" onclick="return confirm(&quot;Click Ok to delete Category.&quot;)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $permissions->render() }}
        </div>
    </div>
@stop