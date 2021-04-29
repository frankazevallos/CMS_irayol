@extends('layouts.frontend')

@push('title', $page->title )
@push('titleseo', $page->titleseo )
@push('descseo', $page->descseo )
@push('keywordseo', $page->keywordseo )
@push('author', $page->user->name )

@section('content')
    {!! $page->content !!}

    @can('page.edit')
        <div class="floatBtn">
            <div class="dropdown">
                <a href="#" class="btn btn-secondary" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a href="{{ route('pages.create') }}" class="dropdown-item" title="{{__('global.create')}}">
                        <i class="fa fa-plus-circle"></i> {{__('global.create')}}
                    </a>
                    <a href="{{ route('pages.edit', $page->id) }}" class="dropdown-item" title="{{__('global.edit')}}">
                        <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                    </a>
                </div>
            </div>
        </div>
    @endcan
@endsection
