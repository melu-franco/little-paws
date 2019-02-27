<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use App\Tag;
use App\Comment;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Image;
use File;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user, Comment $comment)
    {
        $follows = $user->following->pluck('followed_id')->toArray();
        $posts = Post::where('user_id', $follows)
        ->orWhere('user_id', auth()->user()->id)
        ->latest()->get();
        return view('dashboard.index', compact('posts','user','comment'));
    }

    public function store(Request $request, Post $post, User $user)
    {
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'content' => ['required_without:image','max:1000'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $post = Post::create([
            'content' => request('content'),
            'image' => request('image'),
            'user_id' => $user_id,
        ]);

        if($request->hasfile('image')){
            $file = $request->file('image');
            $thumbnail_path = public_path('uploads/posts/thumbnail/');
            $original_path = public_path('uploads/posts/');
            $imageName = 'post_'. $post->id .'_'. time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file->getRealPath());

            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $original_path . $imageName);
                $image->resize(180, 180,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnail_path . $imageName);
            } else {
                $image->save($original_path . $imageName)
                      ->resize(180, 180,function ($constraint) {
                          $constraint->aspectRatio();
                      })
                      ->save($thumbnail_path . $imageName);
            }

            $post->update(['image' => $imageName]);
        }

        return back();
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('dashboard.post-edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {

        $post->update(request()->validate([
            'content' => ['required_without:image','max:1000'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]));

        if($request->hasfile('image')){
            $file = $request->file('image');
            $original_path = public_path('uploads/posts/');
            $thumbnail_path = public_path('uploads/posts/thumbnail/');
            $file_original  = $original_path.$post->image;
            $file_thumbnail = $thumbnail_path.$post->image;

            $filename_new = 'user_'. $post->id .'_'. time() . '.' . $file->getClientOriginalExtension();
            $image_new = Image::make($file->getRealPath());

            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $original_path . $filename_new);
                $image_new->resize(180, 180,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnail_path . $filename_new);
            } else {
                $image_new->save($original_path . $filename_new)
                        ->resize(180, 180,function ($constraint) {
                            $constraint->aspectRatio();
                        })
                      ->save($thumbnail_path . $filename_new);
            }

            if(File::exists($file_original) && File::exists($file_thumbnail)) {

                File::delete($file_original);
                File::delete($file_thumbnail);
            }

            $post->update(['image' => $filename_new]);
        }

        return back();
    }

    public function delete_image(Post $post){
        $original_path = public_path('uploads/posts/');
        $thumbnail_path = public_path('uploads/posts/thumbnail/');
        $file_original  = $original_path.$post->image;
        $file_thumbnail = $thumbnail_path.$post->image;

        if(File::exists($file_original) && File::exists($file_thumbnail)) {
            File::delete($file_original);
            File::delete($file_thumbnail);
            $post->update(['image' => ""]);
        }

        return back();
    }


    public function destroy(Post $post)
    {
        $post->delete();
        $postImage  = public_path('uploads/posts/').$post->image;
        if(File::exists($postImage) && $post->image != "") {
            File::delete($postImage);
        }

        return back();
    }

    public function like(Request $request, Post $post, Like $like) {

        $like->like = '1';
        $like->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->likes()->save($like);

        return back();

    }

    public function dislike(Like $like)
    {
        $like->delete();

        return back();
    }

    public function tag(Request $request, Post $post, Tag $tag) {

        $tag->tag = '1';
        $tag->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->likes()->save($tag);

        return back();

    }

    public function delete_tag(Tag $tag)
    {
        $tag->delete();

        return back();
    }
}
