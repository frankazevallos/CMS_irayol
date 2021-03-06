@extends('layouts.app')
@push('title', __('global.pages'))
@section('content')
    <form action="{{route('pages.update', $page->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-8">

				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.title')}}</span>
								</div>
								<input type="text" class="form-control" id="title" value="{{ $page->title }}" name="title" placeholder="{{__('global.title')}}" />
								@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
                </div>

                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.url')}}</span>
								</div>
                        		<input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" placeholder="{{__('global.url')}}" />
								@if ($errors->has('slug'))
								<span class="help-block">
									<strong>{{ $errors->first('slug') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>

                <div class="form-group">
                    <textarea id="summernote" class="summernote" name="content" hidden>{{ $page->content }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{__('global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">{{__('global.users.title')}}</label>
                            <select class="form-control select2" id="user_id" name="user_id">
                                @foreach ($users as $key => $user)
                                    <option value="{{$key}}" {{$key == $page->user_id ? 'selected' : ''}}>{{$user}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
				<div class="card" id="accordionExample">
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
					</a>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-group">
								<label for="title">{{__('global.seo_title')}}</label>
								<input type="text" class="form-control" id="titleseo" name="titleseo" value="{{ $page->titleseo }}" />
							</div>
							<div class="form-group">
								<label for="content">{{__('global.seo_description')}}</label>
								<textarea class="form-control" rows="3" name="descriptionseo">{{ $page->descseo }}</textarea>
							</div>
							<div class="form-group">
								<label for="content">{{__('global.seo_keyword')}}</label>
								<textarea class="form-control" rows="3" name="keywordseo">{{ $page->keywordseo }}</textarea>
							</div>
						</div>
					</div>
				</div>

                <input type="hidden" name="author" value="{{ Auth::user()->name }}" />

                {{ csrf_field() }}
				<input type="hidden" name="_method" value="put"/>
				<div class="row">
					<div class="col-6 mt-3">
						<input type="submit" name="submit" value="{{__('global.save')}}" class="btn btn-primary btn-block" />
					</div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('pages.index')}}">{{__('global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>
@endsection
