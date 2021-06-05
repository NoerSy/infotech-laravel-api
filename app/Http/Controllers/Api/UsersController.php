<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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

}
