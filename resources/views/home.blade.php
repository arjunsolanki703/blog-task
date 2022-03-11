@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-between">
		<div class="col-md-12">
			@foreach ($blogs as $blog)
			<div class="mb-3 d-flex justify-content-between">
				<div class="pr-3">
					<h2 class="mb-1 h4 font-weight-bold">
					@if (strtotime(date("Y-m-d", time() - date("Z"))) == strtotime(date('Y-m-d', strtotime($blog->created_at))))
					<a class="text-dark" href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
					@else 
					<a class="text-dark font-weight-normal" href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
					@endif
					</h2>
					<p>
						{{ $blog->short_description }}
					</p>
					<div class="card-text text-muted small">
						{{ $blog->user->name }}
					</div>
					<small class="text-muted">{{ date('d M', strtotime($blog->created_at)); }}</small>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
