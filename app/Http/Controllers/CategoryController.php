<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorie=Category::latest()->paginate(10);
        $data=[
            'categories'=>$categorie,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorie=Category::get();
        $data=[
            'categories'=>$categorie,
        ];
        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                'name'=>'required',
                'user_id'=>'required',

            ]);
            Category::create([
                'name'=>$request->name,
                'user_id'=>$request->user_id,

            ]);
            return response()->json([
                'message'=>'Berhasil Mebambahkan data',
                'status'=>'succes',
                'code'=>201,
            ],201);

        }
        catch(ValidationException $ex){
            return response()->json([
                'message'=>$ex->getMessage(),
                'status'=>'failed',
                'errors'=>$ex->errors(),
                'code'=>500
            ],500);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $categorie = Category::find($id);
        return response()->json($categorie,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $request->validate([
                'name'=>['required'],
                'user_id'=>['required'],

            ]);
            $validated=[
                'name'=>$request->name,
                'user_id'=>$request->user_id,
            ];
            Category::find($id)->update($validated);
            return response()->json([
                'message'=>'Data berhasil di update',
                'status'=>'success',
                'code'=>201
            ],201);

        }
        catch(ValidationException $ex){
            return response()->json([
                'message'=>$ex->getMessage(),
                'status'=>'failed',
                'erroes'=>$ex->errors(),
                'code'=>500
            ],500);

        }

        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Category::find($id)->delete();
        return response()->json([
            'message'=>'Data berhasil di hapus',
            'status'=>'success',
            'code'=>201
        ],201);
    }
}
