<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::all();
        return response([
            'total' => $users->count(),
            'messages' => 'Retrieved successfuly',
            'data' => UserResource::collection($users)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $user = Users::find($id);

        if ($user == null) {
            return response([
                'message' => 'No data found!',
            ], 403);
        }

        if (!Hash::check($request->input("password"), $user->password)) {
            return response([
                'message' => 'password wrong!',
                'password' => Hash::check($request->input("password"), $user->password)
            ]);
        }

        $user->delete();
        return response(['message' => 'user has been deleted!']);
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $user = Users::find($id)->update([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'image' =>  $request->input('image'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'message' => 'User has been update!',
            'user' => $user
        ]);
    }
}
