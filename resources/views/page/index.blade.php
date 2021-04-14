@extends('layouts.app')
@push('title', 'List Your Page')

@section('content')

<div class="card">
	<div class="card-header container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{__('global.list_page')}}
            </div>
            <div class="col-md-6">
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="{{ route('page.create') }}" class="btn btn-success" title="Create New Setting"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                </div>
            </div>
        </div>
	</div>
	<div class="card-body">
        <table class="table table-hover data-table-page">
            <thead>
                <tr>
                    <th>{{__('global.title')}}</th>
                    <th>{{__('global.author')}}</th>
                    <th>{{__('global.update_at')}}</th>
                    <th>{{__('global.main_page')}}</th>
                    <th>{{__('global.action')}}</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($allpage as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td><a href="{{ route('users.show', $page->user->id ) }}">{{ $page->user->name }}</a></td>
                    <td>{{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}</td>
                    <td>
                        <form action="{{route('page.active')}}" method="POST">
                            @csrf
                            <input type="text" hidden value="{{ $page->id }}">
                            <button type="submit" class="btn btn-{{ $page->id == setting('main_page') ? 'success' : 'secondary' }} btn-sm">{{ $page->id == setting('main_page') ? __('global.active') : __('global.inactive') }}</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{!! route('page.destroy', $page->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}
                            <div class="btn-group btn-group-xs float-right" role="group">
                                <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-info btn-sm" title="Show Users">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Page.&quot;)">
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