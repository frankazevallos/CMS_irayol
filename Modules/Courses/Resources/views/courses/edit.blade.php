@extends('layouts.app')
@push('title', 'Create Course') 
@section('content')    
    <form method="POST" action="{{ route('courses.update', $course->id) }}" accept-charset="UTF-8" id="create_category_form" name="create_category_form" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('courses::global.title')}}</span>
								</div>
                        		<input type="text" class="form-control" id="title" name="title" value="{{  old('title', $course->title) }}" required />
							</div>
						</div>
					</div>
                </div>
                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('courses::global.url')}}</span>
								</div>
                    			<input type="text" class="form-control" id="slug" name="slug" value="{{ $course->slug }}" placeholder="URL" />
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
                    <textarea id="description" name="description" class="form-control summernote" rows="20" name="content">{{ $course->description }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{__('courses::global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">{{__('courses::global.categories')}}</label>
                            <select class="form-control select2" id="category" name="category[]" multiple>
                                @foreach ($categories as $key => $category)
                                    <option value="{{$key}}" {{ collect(old('category', $course->categories->pluck('id')))->contains($key) ? 'selected' : '' }}>{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">{{__('courses::global.level')}}</label>
                            <select class="form-control" id="level" name="level" >
                                <option selected="" disabled>{{__('courses::global.select_level')}}</option>
                                @foreach ($data = array('basic' => __('courses::global.basic'), 'intermediate' => __('courses::global.intermediate'), 'advance' => __('courses::global.advance')); as $key => $level)                                    
                                    <option value="{{$key}}" {{ $course->level == $key ? 'selected' : '' }}>{{$level}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('courses::global.visibility')}}</label>
                            <select class="custom-select" id="visibility" name="visibility">
                                <option selected="" disabled>{{__('courses::global.select_option')}}</option>
                                @foreach ($data = array('published' => __('courses::global.published'), 'draft' => __('courses::global.draft'), 'pending_review' => __('courses::global.pending_review')); as $key => $visibility)                                    
                                    <option value="{{$key}}" {{ $course->visibility == $key ? 'selected' : '' }}>{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('courses::global.image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="main_image" name="image" value="{{ $course->image }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#MainImageModal">{{__('courses::global.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <a href="#" data-toggle="modal" data-target="#MainImageModal">
                            <img class="img-fluid rounded" name="ImageMainSelect" id="ImageMainSelect" src="{{ $course->image }}" >
                        </a>
                    </div>
                </div>
                <div class="card mt-3" id="accordionSEO">
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">					
						SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
					</a>					
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSEO">
						<div class="card-body">
                            <div class="form-group">
                                <label for="required">{{__('courses::global.requirements')}}</label> 
                                <textarea id="required" name="required" cols="40" rows="3" class="form-control">{{ $course->required }}</textarea>
                            </div> 
                            <div class="form-group">
                                <label for="includes">{{__('courses::global.includes')}}</label> 
                                <textarea id="includes" name="includes" cols="40" rows="3" class="form-control">{{ $course->includes }}</textarea>
                            </div> 
							<div class="form-group">
                                <label for="keywords">{{__('courses::global.keywords')}}</label> 
                                <textarea id="keywords" name="keywords" cols="40" rows="3" class="form-control">{{ $course->keywords }}</textarea>
                            </div> 
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-6 mt-3">
                        <button class="btn btn-primary btn-block">{{__('courses::global.save')}}</button>				
                    </div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('courses.index')}}">{{__('courses::global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>

<!--Main Image Modal-->
<div class="modal fade" id="MainImageModal" tabindex="-1" role="dialog" aria-labelledby="MainImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MainImageModal">Image library</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($medias as $media)
                    <div class="col-md-3 mt-3">
                        @if($media->extension == 'png' || $media->extension == 'jpg' || $media->extension == 'jpeg')
                        <a data-toggle="modal" data-target="#{{ $media->id }}">
                            <img class="thumbnail img-fluid rounded filter image addMainImage" alt="" data-src="{{ $media->path }}" />
                        </a>
                        @endif
                    </div>
                    <!-- col-md-2 / end -->
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" data-id="" id="MainPhoto" type="button">Insert</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--Main Image Modal-->
@endsection