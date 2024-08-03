<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\NewCommentEvent;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with([
            'comments' => function ($q) {
                $q->select('id', 'post_id', 'comment');
            }
        ])->get();
        return view('Dashboard.posts.post', compact('posts'));
    }

    public function create(Request $request)
    {
        Comment::create([
            'post_id' => $request->post_id,
            'admin_id' => Auth::id(),
            'comment' => $request->post_content,
        ]);

        $data = [
            'admin_id' => Auth::id(),
            'admin_name' => Auth::user()->name,
            'comment' => $request->post_content,
            'post_id' => $request->post_id,
        ];


        event(new NewCommentEvent($data));

        return redirect()->back()->with(['success' => 'تم اضافه تعليقك بنجاح ']);

    }

}