<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getPost = Post::paginate(10);

        return PostResource::collection($getPost);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =Validator::make($request->all(),[
            // 'title' => 'required|max:5',
            'content' => 'required',
        ]);

        if ($data->fails()) {
            # code...
            return response()->json($data->errors());
        }

        $create = Post::create([
            // 'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => auth()->user()->id,
        ]);

        $create->save();

        $newPost= array(
            'id' =>$create->id,
            'content' =>$create->content,
            'user_id' =>User::find($create->user_id),
        );

        return response()->json([
            'message' => "Post has been created !",
            'result' => $newPost,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);
        if (!$post) {
            # code...
            return response()->json([
                'message' => 'Not Found',
            ]);
        }
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $retrive_post = Post::find($id);
        if (!$retrive_post) {
            # code...
            return response()->json([
                'message' => 'Not Found ',
            ]);
        }
        // $retrive_post->title = $request->get('title');
        $retrive_post->content = $request->get('content');

        $retrive_post->save();

        return response()->json($retrive_post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $retrive_post = Post::find($id);
        if (!$retrive_post) {
            # code...
            return response()->json([
                'message' => 'Not Found ',
            ]);
        }
        $retrive_post ->delete();

        return response([
            'message' => 'This post ' .$id. ' deleted successfully!',
            'post'=> $retrive_post,
        ]);
    }
}
