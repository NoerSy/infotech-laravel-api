<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsoleResource;
use App\Models\Consoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consoles = Consoles::all();
        return response([
            'total' => $consoles->count(),
            'messages' => 'Retrieved successfuly',
            'data' => ConsoleResource::collection($consoles)
        ], 200);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merek' => 'required|string|max:20',
            'type' => 'required|string|max:20',
            'isSewa' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }

        $consoles = Consoles::create([
            'merek' => $request->input('merek'),
            'type' => $request->input('type'),
            'isSewa' => $request->input('isSewa'),
            'image' => $request->input('image'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'message' => 'item has been created!',
            'user' => $consoles
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merek' => 'required|string|max:20',
            'type' => 'required|string|max:20',
            'isSewa' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' => $validator->errors()->toArray()
            ], 400);
        }


        $consoles = Consoles::find($id)->update([
            'merek' => $request->input('merek'),
            'type' => $request->input('type'),
            'isSewa' => $request->input('isSewa'),
            'image' => $request->input('image'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'message' => 'item has been update!',
            'user' => $consoles
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
        $console = Consoles::find($id);
        if ($console != null) {
            $console->delete();
            return response(['message' => 'Console has been deleted!']);
        } else {
            return response([
                'message' => 'No data found!',
            ], 403);
        }
    }
}
