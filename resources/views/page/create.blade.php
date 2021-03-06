@extends('layouts.app')
@push('title', __('global.pages'))
@section('content')
    <form action="{{route('pages.store')}}" method="POST" class="">
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
                                <input type="text" class="form-control" id="title" name="title"/>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea class="summernote" id="summernote" name="content" hidden></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="accordionExample">
                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                    </a>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">{{__('global.seo_title')}}</label>
                                <input type="text" class="form-control" id="titleseo" name="titleseo" placeholder="Title" />
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
