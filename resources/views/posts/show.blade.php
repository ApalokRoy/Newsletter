@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-4">
			<h1>{{  ucwords($post->caption)  }}</h1>
			@if ($post->image)
				<img src="/storage/{{ $post->image }}" class="post-image">
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="d-flex justify-content-between">
				<span>Posted By: 
					<a href="{{ route('users.show', [$post->user->id])  }}">{{  $post->user->name  }}</a>
					at {{  $post->created_at->format('Y-m-d h:i:s A')  }}
				</span>

				@if (auth()->check() && auth()->user()->id == $post->user_id)
					<a href="{{ route('posts.edit', [$post->id]) }}">{{ __('Edit News') }}</a>
					<form method="POST" action="{{ route('posts.destroy',[$post->id]) }}">
		                @csrf
		                @method('DELETE')

		                <input type="submit" name="delete" value="{{ __('Delete News') }}" class="btn btn-link">
					</form>
				@endif
			</div>

			<p class="mt-4 post-description">{{  $post->description  }}</p>
		</div>		
	</div>
</div>
@endsection