@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4 text-md-center">
                <h1>{{ __('ADD NEW POST') }}</h1>
            </div>

            <div>
                <form method="POST" action="/posts/{{ $post->id  }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label text-md-right required">{{ __('Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') ?? $post->caption }}" required autofocus>

                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right required">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" row="5" column="40" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') ?? $post->description  }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Add / Update Image') }}</label>

                        <div class="col-md-6">
                            @if($post->image)
                                <img src="/storage/{{ $post->image }}" class="edit-image">
                                <span class="float-left"><small class="text-muted">
                                    If You Upload New Image Existing Image Will Be Deleted.
                                </small></span>
                            @endif

                            <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" accept="image/*">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('UPDATE POST') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
