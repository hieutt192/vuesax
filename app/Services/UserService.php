<?php
namespace App\Services;

use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService {

    /**
     * Show a listing of the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        // $sort_direction = request('sort_direction','desc');
        // if(!in_array($sort_direction,['asc','desc'])){
        //     $sort_direction = 'desc';
        // }
        // $sort_field = request('sort_field','id');
        // $sort_field="users.".''.$sort_field;
        // if (!in_array($sort_field,['users.name','users.email','users.id','users.phone'])){
        //     $sort_field='roles.name';
        // }
        // $search=request('search','');

        // if ($search) {
        //     # code...
        //     $user = User::select([
        //         'users.id',
        //         'first_name',
        //         'email',
        //         'phone',
        //         'last_login',
        //         'users.created_at',
        //         'role_id',
        //         'email_verified_at',
        //         'users.permissions',
        //         'roles.name as role_name',

        //     ])
        //     ->whereRaw('match(email,users.first_name) against(?)', array($search))
        //     ->join('role_users','users.id', '=','user_id')
        //     ->join('roles','role_id','=','roles.id')
        //     ->orderBy($sort_field,$sort_direction)
        //     -> paginate(10);
        // } else {
        //     # code...
        //     $user = User::select([
        //         'users.id',
        //         'first_name',
        //         'email',
        //         'phone',
        //         'last_login',
        //         'users.created_at',
        //         'role_id',
        //         'email_verified_at',
        //         'users.permissions',
        //         'roles.name as role_name',

        //     ])
        //     ->join('role_users','users.id', '=','user_id')
        //     ->join('roles','role_id','=','roles.id')
        //     ->orderBy($sort_field,$sort_direction)
        //     -> paginate(10);
        // }
        // return $this->withData($user, 'List User');

        $user = User::select([
            'users.id',
            'first_name',
            'email',
            'phone',
            'last_login',
            'users.created_at',
            'role_id',
            'email_verified_at',
            'users.permissions',
            'roles.name as role_name',

        ])
        ->join('role_users','users.id', '=','user_id')
        ->join('roles','role_id','=','roles.id')
        -> paginate(10);


        return response()->json($user,200);
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
    public function store($request)
    {
        //
        $data =$request->all();



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
    public function update($request, $id)
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

    public function search(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|max:255'
        ]);
        if ($validated->fails()) {
            return $this->failValidator($validated);
        }
        $users=User::whereRaw('match(name,email,phone) against(?)', array($request['email']))
                    ->get();
        return $this->withData($users, 'Search done');
    }


}
