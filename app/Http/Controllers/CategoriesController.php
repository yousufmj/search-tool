<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Resources\categories as categoriesResource;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories = Categories::all();

        return categoriesResource::collection($Categories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = new Categories;

        $categories->name = $request->input('name');

        if ($categories->save()) {
            return new categoriesResource($categories);
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
        $categories = Categories::findOrfail($id);

        return new categoriesResource($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id -id of categories
     * @param  obj  $request - the request body for changes
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $categories = Categories::findOrFail($id);

        $categories->name = $request->input('name');

        if ($categories->save()) {
            return new categoriesResource($categories);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id - id of categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Categories::findOrFail($id);

        if ($categories->delete()) {
            return new categoriesResource($categories);
        }
    }
}
