@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-between">
		<div class="col-md-12">
			<div class="h4 my-4">{{ __('My Blogs') }}</div>

			<table class="table">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Short Description</th>
					<th scope="col">Tags</th>
					<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($blogs as $key => $blog)
					<tr>
						<th scope="row">{{ $key+1 }}</th>
						<td>{{ $blog->title }}</td>
						<td>{{ $blog->short_description }}</td>
						<td>{{ $blog->tags }}</td>
						<td>
						<div class="btn-group btn-group-sm" role="group" aria-label="Third group">
							<a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-secondary text-white">Edit</a>
							<form action="{{ route('blog.destroy',$blog->id) }}" method="Post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
