<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $user = User::paginate(10);
        // $user = User::get();

        // return UserResource::collection($user);
        return response()->json($user);
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
        //
        $data =Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'email|required|unique:users,email|max:255',
            'phone' => 'required',
            'role' => 'required'

        ]);

        if ($data->fails()) {
            # code...
            return response()->json($data->errors());
        }

        $create = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('phone')),
            'phone' => $request->get('phone'),
            'role' => $request->get('role'),
        ]);

        $create->save();

        $newUser= array(
            'id' => $create ->id,
            'name' =>$create->name,
            'email' =>$create->email,
            'password' => $create->password,
            'phone' =>$create->phone,
            'role' =>$create->role,
        );

        return response()->json([
            'message' => "User has been created !",
            'result' => $newUser,
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
        //
        $user = User::find($id);
        if (!$user) {
            # code...
            return response()->json([
                'message' => 'Not Found User',
            ]);
        }

        return response()->json($user);
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
        $retrive_user = User::find($id);
        if (!$retrive_user) {
            return response()->json([
                'message' => 'Not Found User',
            ]);
        }
        $retrive_user->name = $request->get('name');
        $retrive_user->email = $request->get('email');
        $retrive_user->phone = $request->get('phone');
        $retrive_user->role = $request->get('role');
        $retrive_user->save();

        $newUser= array(
            'name' =>$retrive_user->name,
            'email' =>$retrive_user->email,
            'phone' =>$retrive_user->phone,
            'role' =>$retrive_user->role,
        );

        return response()->json([
            'message' => 'User has been update !',
            'result' => $newUser,
        ],200);
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
        $retrive_user = User::find($id);

        if (!$retrive_user) {
            # code...
            return response()->json([
                'message' => 'Not Found User',
            ]);
        }
        $retrive_user ->delete();

        return response([
            'message' => 'User with "'.$retrive_user['name'].'" deleted successfully!',
            'post'=> $retrive_user,
        ]);
    }
}
