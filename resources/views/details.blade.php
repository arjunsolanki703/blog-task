@extends('layouts.app')

@section('content')
<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
		<div class="h-100 tofront">
			<div class="row justify-content-between">
				<div class="col-md-12 pt-6 pb-6 pr-6 align-self-center">
					<p class="text-uppercase font-weight-bold">
					</p>
					<h1 class="display-4 secondfont mb-3 font-weight-bold">{{ $blog->title }}</h1>
					<p class="mb-3">
						{{ $blog->short_description }}
					</p>
					<div class="d-flex align-items-center">
						<small class="ml-2">{{ $blog->user->name }} <span class="text-muted d-block">{{ date('d M', strtotime($blog->created_at)); }}</span>
						</small>
					</div>
				</div>
				<div class="col-md-12 col-lg-12">
					<article class="article-post">
						{!! $blog->long_description !!}
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
