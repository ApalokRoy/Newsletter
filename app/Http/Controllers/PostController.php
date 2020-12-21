<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use File; 

class PostController extends Controller
{
	public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function create() {
    	return view('posts.create');
    }

    public function store() {
    	$data = request()->validate([
    		'caption' => 'required',
    		'description' => 'required',
    		'image' => 'image',
    	]);

    	if (request('image')) {
	    	$imagePath = request('image')->store('uploads', 'public');
            $data = array_merge($data, ['image' => $imagePath]);
	    }

    	$id = auth()->user()->posts()->create($data)->id;

        \Session::flash('alert-success', 'News successfully created!');
        return redirect()->route('posts.show', $id);
    }


    public function show(Post $post) {
    	return view('posts.show', compact('post'));
    }

    public function edit(Post $post) {
        if(auth()->user()->id != $post->user_id) {
            \Session::flash('alert-warning', 'You are not Authorized to perform the action!');
            return redirect('/');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post) {
        if(auth()->user()->id != $post->user_id) {
            \Session::flash('alert-warning', 'You are not Authorized to perform the action!');
            return redirect('/');
        }

        $data = request()->validate([
            'caption' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        if (request('image')) {
            if ($post->image) {

                $file_path = storage_path() . "/app/public/" . $post->image;

                if(File::exists($file_path)) {
                    File::delete($file_path);
                } else {
                    \Session::flash('alert-warning', 'File does not exists.');
                    return redirect('/');
                }
            }

            $imagePath = request('image')->store('uploads', 'public');
            $data = array_merge($data, ['image' => $imagePath]);
        }

        $post->update($data);

        if($post->wasChanged()) {
            \Session::flash('alert-success', 'News successfully updated!');
        }

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post) {
        if(auth()->user()->id != $post->user_id) {
            \Session::flash('alert-warning', 'You are not Authorized to perform the action!');
            return redirect('/');
        }

        $post->delete();
        
        \Session::flash('alert-success', 'News successfully deleted!');
        return redirect('/');
    }

    public function index() {
        $posts = Post::with('user')->orderBy('created_at', 'DESC')->paginate(5);
        return view('posts.index', compact('posts'));
    }
}
