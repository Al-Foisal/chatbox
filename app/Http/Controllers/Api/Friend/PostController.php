<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller {
    public function index($user_id) {
        $post = Post::where('user_id', $user_id)
            ->with(['images', 'videos', 'comments'])
            ->withCount('likes')
            ->get();

        return $post;
    }

    public function create(Request $request) {
        $post          = new Post();
        $post->user_id = $request->user_id;
        $post->caption = $request->caption;
        $post->save();

        /**
         * multiple image insertion
         * ------------------------
         */

        if ($request->hasFile('image')) {
            $files = [];

            foreach ($request->file('image') as $file) {
                $name = time() . rand(1111, 9999) . '.' . $file->extension();
                $file->move(public_path('images/post/img/'), $name);
                $files[] = 'iamges/post/img/' . $name;
            }

            foreach ($files as $file) {
                $post_image          = new PostImage();
                $post_image->post_id = $post->id;
                $post_image->image   = $file;
                $post_image->save();
            }

        }

        /**
         * multiple video insertion
         * ------------------------
         */

        if ($request->hasFile('video')) {
            $files = [];

            foreach ($request->file('video') as $file) {
                $name = time() . rand(1111, 9999) . '.' . $file->extension();
                $file->move(public_path('images/post/video/'), $name);
                $files[] = 'iamges/post/video/' . $name;
            }

            foreach ($files as $file) {
                $post_video          = new PostVideo();
                $post_video->post_id = $post->id;
                $post_video->video   = $file;
                $post_video->save();
            }

        }

        return response()->json(['status' => true, 'message' => 'Post added!!']);
    }

    public function details($post_id) {
        $post = Post::where('id', $post_id)
            ->with(['images', 'videos', 'comments'])
            ->withCount('likes')
            ->first();

        return $post;
    }

    public function delete(Request $request) {
        $post = Post::where('id', $request->post_id)->first();

        $comment = PostComment::where('post_id', $post->id)->get();
        $likes   = PostLike::where('post_id', $post->id)->get();

        foreach ($comment as $value) {
            $value->delete();
        }

        foreach ($likes as $like) {
            $like->delete();
        }

        //deleting related post image
        $post_image = PostImage::where('post_id', $post->id)->get();

        if ($post_image->count() > 0) {

            foreach ($post_image as $image) {
                $image_path = public_path($image->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $image->delete();
            }

        }

        //deleting related post video
        $post_video = PostVideo::where('post_id', $post->id)->get();

        if ($post_video->count() > 0) {

            foreach ($post_video as $video) {
                $video_path = public_path($video->video);

                if (File::exists($video_path)) {
                    File::delete($video_path);
                }

                $video->delete();
            }

        }

        $post->delete();

        return response()->json(['status' => true, 'message' => 'Post deleted!!']);

    }

    public function commentCreate(Request $request) {
        $post_comment          = new PostComment();
        $post_comment->post_id = $request->post_id;
        $post_comment->user_id = $request->user_id;
        $post_comment->comment = $request->comment;
        $post_comment->save();

        return $post_comment;
    }

    public function commentDelete(Request $request) {
        $post_comment = PostComment::find($request->comment_id);

        if ($post_comment->user_id != $request->user_id) {
            return response()->json(['status' => false]);
        }

        $post_comment->delete();

        return response()->json(['status' => true]);
    }

    public function likeDislike(Request $request) {
        $post_like = PostLike::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();

        if (!$post_like) {
            $post_like          = new PostLike();
            $post_like->user_id = $request->user_id;
            $post_like->post_id = $request->post_id;
            $post_like->save();

            return response()->json(['count' => PostLike::where('post_id', $request->post_id)->count()]);
        } else {
            $post_like->delete();

            return response()->json(['count' => PostLike::where('post_id', $request->post_id)->count()]);
        }

    }

}
