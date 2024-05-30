<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = services::where('user_id', Auth::id())->get();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->headers->set('Content-Type', 'application/json');
        $data = json_decode($request->getContent(), true);
    
        $validator = Validator::make($data, [
            'type' => 'required',
            'service_type' => 'required',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'kitchen' => 'required|integer',
            'etat' => 'required',
            'options' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'frequence' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $service = new Service();
        $service->type = $request->type;
        $service->service_type = $request->service_type;
        $service->bedroom = $request->bedroom;
        $service->bathroom = $request->bathroom;
        $service->kitchen = $request->kitchen;
        $service->etat = $request->etat;
        $service->options = $request->options;
        $service->date_start = $request->date_start;
        $service->date_end = $request->date_end;
        $service->frequence = $request->frequence;
        $service->user_id = Auth::id();
        $service->save();

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = services::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        return response()->json($service);
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
        $service = services::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'service_type' => 'required',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'kitchen' => 'required|integer',
            'etat' => 'required',
            'options' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'frequence' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $service->type = $request->type;
        $service->service_type = $request->service_type;
        $service->bedroom = $request->bedroom;
        $service->bathroom = $request->bathroom;
        $service->kitchen = $request->kitchen;
        $service->etat = $request->etat;
        $service->options = $request->options;
        $service->date_start = $request->date_start;
        $service->date_end = $request->date_end;
        $service->frequence = $request->frequence;
        $service->save();

        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = services::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
