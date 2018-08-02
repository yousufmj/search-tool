<?php

namespace App\Http\Controllers;

use App\Businesses;
use App\Http\Resources\Business as BusinessResource;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Businesses::paginate(20);

        return BusinessResource::collection($businesses);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $business = new Businesses;

        $business->title = $request->input('title');

        if ($business->save()) {
            return new BusinessResource($business);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Businesses::findOrfail($id);

        return new BusinessResource($business);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id -id of business
     * @param  obj  $request - the request body for changes
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $business = Businesses::findOrFail($id);

        $business->title = $request->input('title');

        if ($business->save()) {
            return new BusinessResource($business);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id - id of business
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Businesses::findOrFail($id);

        if ($business->delete()) {
            return new BusinessResource($business);
        }
    }
}
