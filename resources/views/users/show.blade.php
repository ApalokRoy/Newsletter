@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>{{  $user->name  }}</h1>
			<span>Registered mail-id: {{  $user->email  }}</span>
			@if (auth()->check() && auth()->user()->id == $user->id)
				<a class="float-right" href="{{ route('users.edit', [$user->id])  }}">{{ __('Edit Profile') }}</a>
			@endif
            <hr>
		</div>
	</div>

	<div class="pt-4">
		@if (auth()->check() && auth()->user()->id == $user->id)
			<a class="float-right" href="{{ route('posts.create')  }}">{{ __('Add New Post') }}</a>
		@endif

		@if ($posts->count() > 0)
			<div>
				<h3>
					Contribution: 
					Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }}
					of {{$posts->total()}} @choice('Post|Posts', $posts->total())

				</h3>
				@foreach($posts as $post)
					<div class="card mt-2">
						<div class="card-header">
		    				<span class="font-weight-bold">{{  ucwords($post-> caption)  }}</span>
		    				<span class="float-right">Published At: {{  $post->created_at->format('Y-m-d h:i:s A')  }}</span>
				  		</div>
		  				<div class="card-body">
		  					<div class="row">
		  						<div class="col-md-10 pb-2">
									<p class="card-text user-post-description">{{  $post-> description  }}</p>
								</div>
								<div class="col-md-2">
									@if ($post->image)
										<img src="/storage/{{ $post->image }}" class="mw-100">
									@endif
								</div>
							</div>
		    				<a href="{{ route('posts.show', [$post->id])  }}" class="btn btn-primary">Read Full News</a>
		  				</div>
					</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center mt-2">
					{{ $posts->links('pagination::bootstrap-4') }}
				</div>		
			</div>
		@endif
	</div>
</div>
@endsection