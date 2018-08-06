<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpeningHours as openingHoursResource;
use App\Opening_hours;
use Illuminate\Http\Request;

class OpeningHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $openingHours = Opening_hours::paginate(20);

        return openingHoursResource::collection($openingHours);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $openingHours = new Opening_hours;

        $openingHours->name = $request->input('name');

        if ($openingHours->save()) {
            return new openingHoursResource($openingHours);
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
        $openingHours = Opening_hours::findOrfail($id);

        return new openingHoursResource($openingHours);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id -id of openingHours
     * @param  obj  $request - the request body for changes
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $openingHours = Opening_hours::findOrFail($id);

        $openingHours->name = $request->input('name');

        if ($openingHours->save()) {
            return new openingHoursResource($openingHours);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id - id of openingHours
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $openingHours = Opening_hours::findOrFail($id);

        if ($openingHours->delete()) {
            return new openingHoursResource($openingHours);
        }
    }
}
