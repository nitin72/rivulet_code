<?php

namespace App\Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Category\Models\Category;
use App\Modules\Post\Models\Post;
use App\Modules\Post\Models\Comment;

class PostController extends Controller
{
    public function list()
    {
        return view("Post::list");
    }

    public function create() {
        return view('Post::create');
    }

    public function edit($id) {
        return view('Post::edit', compact('id'));
    }

    public function view($id) {
        return view('Post::view', compact('id'));
    }

    public function getPosts($id=null) {
        $data = new Post();
        if (isset($id)) {
            $res = $data->where('id', $id)->get();
        } else {
            $res['posts'] = $data->with('comments')->get();
            // $res['posts'] = $data->get();
        }
        $res['user']=auth()->user()->id;
        return response()->json(['data'=>$res, 200]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['msg'=>'Data error.'], 400);
        }
        if($request->has('file')) {
            $img = $this->storeImage($post->id, $request);
        }
        $post = Post::create([
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'category_id'=>$request->category,
            'img_ext'=>($data['ext']??null)
        ]);
        return response()->json(['msg'=>'Data added successfully.'], 200);
    }

    public function storeImage($id, $request) {
        $file = $request->file('file');
        $data['ext'] = $file->getClientOriginalExtension();
        $file_path =  '/assets/admin/img/post';
        $request->file('file')->storeAs($file_path, $id.'.'.$data['ext'], 'resources');
        return $data;
    }

    public function storeComment(Request $request, $post) {
        Comment::create([
            'post_id'=>$post,
            'description'=>$request->comment,
            'user_id'=>auth()->user()->id
        ]);
        return response()->json(['msg'=>'Data added successfully.'], 200);
    }

    public function getComments($post) {
        $data['comments'] = Comment::join('users', 'users.id', 'comments.user_id')
            ->where('comments.post_id', $post)
            ->select('comments.*', 'users.name')
            ->get();
        $data['count'] = $data['comments']->count();
        return response()->json(['data'=>$data, 200]);  
    }

}
