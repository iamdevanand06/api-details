<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Detail;

use Validator;

use App\Http\Requests;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Detail::all();
        $data = $details->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Details retrieved successfully.'
        ];

        return response()->json($response, 200);

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

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $detail = Detail::create($input);
        $data = $detail->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Detail stored successfully.'
        ];

        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Detail::find($id);

        if (is_null($detail) ) 
        {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Details not found.'
            ];
            return response()->json($response, 404);
        }
        else
        {
            $data = $detail->toArray();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Detail retrieved successfully.'
            ];
            return response()->json($response, 200);
        }

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
    public function update(Request $request, Detail $detail)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $detail->name = $input['name'];
        $detail->address = $input['address'];
        $detail->save();

        $data = $detail->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Details updated successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Detail::where('id', $id)->delete();

        return response()->json([
            'result' => 'Successfully Deleted Details',
            'data' => $data,
        ], 200);
    }
}
