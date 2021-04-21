@extends('layouts.app')
@push('title', __('global.users.title'))
@section('content')

    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                {{__('global.users.title')}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users"><i class="fas fa-plus" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>

        <div class="card-body ">
            <table class="table table-striped data-table-users">
                <thead>
                    <tr>
                        <th>{{__('global.email')}}</th>
                        <th>{{__('global.email_verified_at')}}</th>
                        <th>{{__('global.users.fields.name')}}</th>
                        <th>{{__('global.roles.title')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                </thead>
                {{--<tbody>
                    @foreach($usersObjects as $users)
                        <tr>
                            <td><a href="mailto:{{ $users->email }}">{{ $users->email }}</a></td>
                            <td>{{ $users->email_verified_at }}</td>
                            <td>{{ $users->name }}</td>
                            <td>
                                @foreach ($users->roles()->pluck('name') as $role)
                                    <span class="label label-info label-many">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form method="POST" action="{!! route('users.destroy', $users->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group-xs float-right" role="group">
                                        <a href="{{ route('users.show', $users->id ) }}" class="btn btn-info btn-sm" title="Show Users">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $users->id ) }}" class="btn btn-primary btn-sm" title="Edit Users">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Users" onclick="return confirm(&quot;Click Ok to delete Users.&quot;)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>--}}
            </table>
        </div>
    </div>
@endsection
