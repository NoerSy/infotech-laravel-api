<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsoleResource;
use App\Models\UserSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSewaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $sewa = UserSewa::Where('user_id', auth()->id())->get();
        return response([
            'total' => $sewa->count(),
            'messages' => 'Retrieved successfuly',
            'data' => ConsoleResource::collection($sewa)
        ], 200);
    }

    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sewa_at' => 'required|date',
            'back_at' => 'required|date',
            'console_id' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $id = auth()->id();
        $sewa = UserSewa::create([
            'sewa_at' => $request->input('sewa_at'),
            'back_at' => $request->input('back_at'),
            'is_back' => 1,
            'user_id' => $id,
            'console_id' => $request->input('console_id')
        ]);

        return response()->json([
            'message' => 'Pesanan has been created!',
            'user' => $sewa
        ]);
    }

    public function diambil()
    {
        if (auth()->id() == null) {
            return response()->json([
                'message' => 'your not logined'
            ]);
        }

        $sewa = UserSewa::where('user_id', auth()->id())->update([
            'is_back' => 2,
        ]);

        return response()->json([
            'message' => 'item has been update!',
            'sewa_id' => $sewa
        ]);
    }

    public function dikembalikan()
    {
        if (auth()->id() == null) {
            return response()->json([
                'message' => 'your not logined'
            ]);
        }

        $sewa = UserSewa::where('user_id', auth()->id())->update([
            'is_back' => 3,
        ]);

        return response()->json([
            'message' => 'item has been update!',
            'sewa_id' => $sewa
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sewa = UserSewa::find($id);
        if ($sewa != null) {
            $sewa->delete();
            return response(['message' => 'Pesanan has been deleted!']);
        } else {
            return response([
                'message' => 'No data found!',
            ], 403);
        }
    }
}
