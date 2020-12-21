@extends('layouts.app')

@section('content')
<div class="container">
	<h3>
		Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }}
		of {{$posts->total()}} @choice('Post|Posts', $posts->total())
	</h3>
	<hr>
	<div>
		@foreach($posts as $post)
			<div class="card mt-2">
				<div class="card-header">
    				<span class="font-weight-bold">{{  ucwords($post-> caption)  }}</span>
		  		</div>
  				<div class="card-body">
  					<div class="row">
  						<div class="col-md-10 pb-2">
	  						<h6>Posted By: 
								<a href="{{ route('users.show', [$post->user->id])  }}">
									{{  $post->user->name  }}
								</a>
								at {{  $post->created_at->format('Y-m-d h:i:s A')  }}
							</h6>
							<p class="card-text user-post-description">{{  $post-> description  }}</p>
						</div>
						<div class="col-md-2">
							@if ($post->image)
								<img src="/storage/{{ $post->image }}" class="mw-100">
							@endif
						</div>
					</div>
  				</div>
	  			<div class="card-footer d-flex justify-content-between">
	  				<a href="{{ route('posts.show', [$post->id])  }}">{{ __('Read News') }}</a>

	  				@if (auth()->check() && auth()->user()->id == $post->user_id)
						<a href="{{ route('posts.edit', [$post->id]) }}">{{ __('Edit News') }}</a>
						<form method="POST" action="{{ route('posts.destroy', [$post->id]) }}">
			                @csrf
			                @method('DELETE')

			                <input type="submit" name="delete" value="{{ __('Delete News') }}" class="btn btn-link">
						</form>
					@endif
				</div>
			</div>
		@endforeach	
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center mt-2">
			{{ $posts->links('pagination::bootstrap-4') }}
		</div>		
	</div>
</div>
@endsection