<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $article=Article::with('category')->latest()->paginate(10);
        $data=[
            'articles'=>$article,
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
        $article=Article::get();
        $data=[
            'articles'=>$article,
        ];
        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                'title'=>'required',
                'content'=>'required',
                'image' =>'required|image|mimes:png,jpg',
                'user_id'=>'nullable',
                'category_id'=>'nullable',
            ]);
            Article::create([
                'title'=>$request->title,
                'content'=>$request->content,
                'image'=>$request->file('image')->storeAs('posts',$request->file('image')->hashName()),
                'user_id'=>$request->user_id,
                'category_id'=>$request->category_id,
            ]);
            return response()->json([
                'message'=>'Berhasil menambahkan artikel',
                'status'=>'success',
                'code'=>201
            ],201);


        }
        catch(ValidationException $ex ) {
            return response()->json([
                'message'=> $ex->getMessage(),
                'status'=>'failed',
                'errors'=>$ex->errors(),
                'code'=>500
            ],500);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        $article = Article::find($id);
        return response()->json($article,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        try{
           $request->validate([
                'title'=>['required'],
                'content'=>['required'],
                'user_id'=>['required'],
                'category_id'=>['nullable'],
            ]);
            $validated= [
                'title'=>$request->title,
                'content'=>$request->content,
                'user_id'=>$request->user_id,
                'catogory_id'=>$request->category_id,
            ];
            if($request->file('image')){
                $request->validate([
                    'image'=>['required','image','mimes:png,jpg'],
                ]);

                $validated['image']= $request->file('image')->storeAs('posts',$request->file('image')->hashName());

            }
            Article::find($id)->update($validated);
            return response()->json([
                'message'=>'Data berhasil di update',
                'status'=>'success',
                'code'=>201
            ],201);

        }
        catch(ValidationException $ex ) {
            return response()->json([
                'message'=> $ex->getMessage(),
                'status'=>'failed',
                'errors'=>$ex->errors(),
                'code'=>500
            ],500);

        }
        return response()->json($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Article::find($id)->delete();
        return response()->json([
            'message'=>'Data berhasil di hapus',
            'status'=>'success',
            'code'=>201
        ],201);
    }
}
