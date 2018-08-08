<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Resources\Business as BusinessResource;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->has('query') ? $request->get('query') : '';
        $perPage = $request->has('perPage') ? $request->get('perPage') : 20;

        $business = Business::search($query)->paginate($perPage);
        $business->load('categories');

        return BusinessResource::collection($business);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $business = new Business;

        // declare fields for input
        $business->title = $request->input('title');
        $business->description = $request->input('description');
        $business->trip_advisor = $request->input('trip_advisor');
        $business->location_quarter = $request->input('location_quarter');
        $business->address1 = $request->input('address1');
        $business->address2 = $request->input('address2');
        $business->town = $request->input('town');
        $business->postcode = $request->input('postcode');
        $business->long = $request->input('long');
        $business->lat = $request->input('lat');
        $business->telephone = $request->input('telephone');
        $business->website = $request->input('website');
        $business->email = $request->input('email');
        $business->facebook = $request->input('facebook');
        $business->instagram = $request->input('instagram');
        $business->twitter = $request->input('twitter');
        $business->youtube = $request->input('youtube');

        if ($business->save()) {

            //Loop Categories and attach to pivot table
            $categories = $request->input('categories');
            foreach ($categories as $category) {
                $business->categories()->attach($category);
            }

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
        $business = Business::findOrfail($id);

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
        $business = Business::findOrFail($id);

        // Update rows
        $business->title = $request->input('title');
        $business->description = $request->input('description');
        $business->trip_advisor = $request->input('trip_advisor');
        $business->location_quarter = $request->input('location_quarter');
        $business->address1 = $request->input('address1');
        $business->address2 = $request->input('address2');
        $business->town = $request->input('town');
        $business->postcode = $request->input('postcode');
        $business->long = $request->input('long');
        $business->lat = $request->input('lat');
        $business->telephone = $request->input('telephone');
        $business->website = $request->input('website');
        $business->email = $request->input('email');
        $business->facebook = $request->input('facebook');
        $business->instagram = $request->input('instagram');
        $business->twitter = $request->input('twitter');
        $business->youtube = $request->input('youtube');

        // update relationship data

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
        $business = Business::findOrFail($id);

        if ($business->delete()) {
            return new BusinessResource($business);
        }
    }
}
