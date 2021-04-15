@extends('layouts.app')
@push('title', 'List Your Blog')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                {{__('global.list_blogs')}}
            </div>
            <div class="col-md-6">
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a class="btn btn-success btn-sm" href="{{ route('blogs.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">

            <table class="table table-hover data-table-blog">
                <thead>
                    <tr>
                        <th>{{__('global.title')}}</th>
                        <th>{{__('global.author')}}</th>
                        <th>{{__('global.categories')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                </thead>
                {{--<tbody>
                    @foreach($allblog as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td><a href="{{ route('users.show', $blog->user->id ) }}">{{ $blog->user->name }}</a></td>
                        <td>
                            @foreach ($blog->categories as $category)
                               <a href="{{ route('category.show', $category->id ) }}">{{$category->name}}</a>
                            @endforeach
                        </td>
						<td>{{\Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</td>
						<td>
							<form method="POST" action="{!! route('blog.destroy', $blog->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                <div class="btn-group btn-group-xs float-right" role="group">
                                    <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info btn-sm" title="Show Users">
                                        <i class="far fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
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
