@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(isset($id))
            <form method="POST" action="{{ route('blog.update',$id) }}">    
            @method('PUT')
            @else
            <form method="POST" action="{{ route('blog.store') }}">
            @endif
                @csrf
                <div class="my-2 d-flex justify-content-between">
                    @if(isset($id))
                        <div class="h4">{{ __('Edit Blog') }}</div>
                    @else
                        <div class="h4">{{ __('Add New Blog') }}</div>
                    @endif
                    <button onclick="window.location='{{ URL::to("blog") }}'" class="btn btn-primary">
                        My Blogs
                    </button>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="title" type="text" placeholder="Title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', @$blog->title) }}" required  autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea id="short_description" placeholder="Short description" class="form-control @error('short_description') is-invalid @enderror" name="short_description">{{ old('short_description', @$blog->short_description) }}</textarea>
                        @error('short_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea class="ckeditor form-control @error('long_description') is-invalid @enderror" name="long_description">{{ old('long_description', @$blog->long_description) }}</textarea>
                        @error('long_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <select class="tokenizationSelect2 form-control" name="tags[]" multiple="true">
                            @foreach($explode as $tag)
                                <option value="{{ $tag }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                        @error('long_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0 justify-content-end">
                    <div class="px-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Publish') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
const tags = "<?php echo @$blog->tags; ?>";
$(document).ready(function(){
  $(".tokenizationSelect2").select2({
		placeholder: "Select Tags",
		tags: true,
		tokenSeparators: ['/',',',';'," "] 
	});
})
$('.tokenizationSelect2').val(tags.split(",")).trigger("change")
</script>
@endsection