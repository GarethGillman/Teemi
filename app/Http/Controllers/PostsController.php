<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $current_user_id = Auth()->user()->id;

        $current_posts = Posts::where('userid', '=', $current_user_id)->get();

        $current_posts_count = Posts::where('userid', '=', $current_user_id)->count();
        
        return view('posts.index', ['userid' => $current_user_id, 'posts' => $current_posts, 'posts_count' => $current_posts_count]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string'],
            'status' => ['required', 'string'],
            'userid' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'visibility' => ['required', 'string']
        ]);

        $post = Posts::create([
            'title' => $request->title,
            'userid' => $request->userid,
            'description' => $request->description,
            'excerpt' => $request->excerpt,
            'slug' => $request->slug,
            'status' => $request->status,
            'commenting' => $request->commenting,
            'type' => $request->type,
            'visibility' => $request->visibility,
            'scheduled' => $request->scheduled,
            'seotitle' => $request->seotitle,
            'seodesc' => $request->seodesc
        ]);

        event(new Registered($post));

        return redirect()->route('posts.index')->with('status', 'Post created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $post_id = $request->query->get('id');
        if( $post_id ) {
            $post = Posts::find($post_id);

            return view('posts.edit', ['post' => $post]);
        } else {
            return view('posts.index', ['error' => 'Post not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $posts)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string'],
            'status' => ['required', 'string'],
            'userid' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'visibility' => ['required', 'string']
        ]);

        $post = Posts::query()
            ->update([
                'title' => $request->title,
                'userid' => $request->userid,
                'description' => $request->description,
                'excerpt' => $request->excerpt,
                'slug' => $request->slug,
                'status' => $request->status,
                'commenting' => $request->commenting,
                'type' => $request->type,
                'visibility' => $request->visibility,
                'scheduled' => $request->scheduled,
                'seotitle' => $request->seotitle,
                'seodesc' => $request->seodesc
        ]);

        return redirect()->route('posts.index')->with('status', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Posts $post)
    {
        $post_id = $request->query->get('id');
        if( $post_id ) {
            $post = Posts::where('id', '=', $post_id)->delete();
            
            $current_user_id = Auth()->user()->id;
            $current_posts_count = Posts::where('userid', '=', $current_user_id)->count();

            return view('posts.index', ['status' => 'Post deleted', 'posts_count' => $current_posts_count]);
        } else {
            return view('posts.index', ['error' => 'Post not found']);
        }
    }

    public function single(Request $request, Posts $post)
    {
        $post_id = $request->id;
        if( $post_id ) {
            $post = Posts::where('slug', '=', $post_id)->first();

            return view('posts.single', ['post' => $post]);
        }
        
    }
}
