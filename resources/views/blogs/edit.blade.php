@extends('layouts.app')
@push('title', __('global.blogs'))
@section('content')

    <form action="{{ route('blogs.update', $blog->id ) }}" method="POST" class="">
        <div class="row">
            <div class="col-md-8">

				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.title')}}</span>
								</div>
                    			<input type="text" class="form-control" id="title" name="title" value="{{  old('title', $blog->title) }}" placeholder="Title" />
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
                    			<input type="text" class="form-control" id="slug" name="slug" value="{{ $blog->slug }}" placeholder="URL" />
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
                    <textarea id="summernote" class="form-control summernote" rows="3" name="content">{{ $blog->content }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        {{__('global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="visibility">{{__('global.visibility')}}</label>
                            <select class="custom-select select2" id="visibility" name="visibility">
                                <option selected="" disabled>Open this select visibility</option>
                                @foreach ($data = array('published' => 'Published', 'draft' => 'Draft', 'pending_review' => 'Pending Review'); as $key => $visibility)
                                    <option value="{{$key}}" {{ $blog->visibility == $key ? 'selected' : '' }}>{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{__('global.users.title')}}</label>
                            <select class="form-control select2" id="user_id" name="user_id">
                                @foreach ($users as $key => $user)
                                    <option value="{{$key}}" {{$key == $blog->user_id ? 'selected' : ''}}>{{$user}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('global.created_at')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control datetimepicker-input" id="published_at" name="published_at" value="{{ $blog->published_at }}" data-toggle="datetimepicker" data-target="#published_at"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">{{__('global.categories')}}</label>
                            <select multiple="multiple" class="form-control select2" id="category" name="category[]" >
                                @foreach ($categories as $key => $category)
                                    <option value="{{$key}}" {{ collect(old('category', $blog->categories->pluck('id')))->contains($key) ? 'selected' : '' }}>{{$category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('global.main_image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="main_image" name="main_image" value="{{ $blog->main_image }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary insertMainImageModal" type="button">{{__('global.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#MainImageModal">
                            <img class="img-fluid rounded" name="ImageMainSelect" id="ImageMainSelect" src="{{ $blog->main_image }}" >
                        </a>
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
								<input type="text" class="form-control" id="titleseo" name="titleseo" value="{{ $blog->titleseo }}" />
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_description')}}</label>
								<textarea class="form-control" rows="3" name="descriptionseo">{{ $blog->descseo }}</textarea>
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_keyword')}}</label>
								<textarea class="form-control" rows="3" name="keywordseo">{{ $blog->keywordseo }}</textarea>
							</div>
						</div>
					</div>
				</div>

                {{ csrf_field() }}
				<input type="hidden" name="_method" value="put" />
				<div class="row">
					<div class="col-6 mt-3">
						<input type="submit" name="submit" value="{{__('global.save')}}" class="btn btn-primary btn-block" />
					</div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('blogs.index')}}">{{__('global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>
@endsection
