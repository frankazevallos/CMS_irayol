@extends('layouts.app')
@push('title', __('global.blogs'))
@section('content')
	<form action="{{route('blogs.store')}}" method="POST" class="">
        <div class="row">
            <div class="col-md-8">
				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.title')}}</span>
								</div>
                        		<input type="text" class="form-control" id="title" name="title" placeholder="Title" />
							</div>
						</div>
					</div>
                </div>
                <div class="form-group">
                    <textarea id="summernote" class="form-control summernote" rows="20" name="content">Hello, World!</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{__('global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="visibility">{{__('global.visibility')}}</label>
                            <select class="custom-select select2" id="visibility" name="visibility">
                                @foreach ($data = array('published' => __('global.published'), 'draft' => __('global.draft'), 'pending_review' => __('global.pending_review')); as $key => $visibility)
                                    <option value="{{$key}}">{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">{{__('global.categories')}}</label>
                            <select multiple="" class="form-control select2" id="category" name="category[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('global.created_at')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control datetimepicker-input" id="published_at" name="published_at" value="{{  date('Y-m-d h:m') }}" data-toggle="datetimepicker" data-target="#published_at"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('global.main_image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" id="main_image" name="main_image" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary insertMainImageModal" type="button">{{__('global.search')}}</button>
                                </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#MainImageModal">
                                <img class="img-fluid rounded" name="ImageMainSelect" id="ImageMainSelect" src="{{ asset('manager/images/placeholder.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
				<div class="card mt-3" id="accordionExample">
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						SEO
					</a>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-group">
								<label for="title">{{__('global.seo_title')}}</label>
								<input type="text" class="form-control" id="titleseo" name="titleseo"/>
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_description')}}</label>
								<textarea class="form-control" rows="3" name="descriptionseo"></textarea>
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_keyword')}}</label>
								<textarea class="form-control" rows="3" name="keywordseo"></textarea>
							</div>
						</div>
					</div>
				</div>

				{{ csrf_field() }}
				<div class="row">
					<div class="col-6 mt-3">
						<input type="submit" name="submit" value="Save" class="btn btn-primary btn-block" />					
                    </div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('blogs.index')}}">{{__('global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>
@endsection
