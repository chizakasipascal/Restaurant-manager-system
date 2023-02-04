<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
 
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("categories.index")->with([
            "categories" => Category::paginate(10);
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //validation
        $request->validate($request,[
            'title' =>'required'
        ]); 
        // store category
        $title = $request->title; 
        Category::create([
            'title' =>$title,
            'slug' =>Str::slug($title)
        ]);
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "catégorie ajoutée avec succés"
        ]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view("categories.index")->with([
            "category" => $category;
        ]);
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
        return view("categories.edit")->with([
            "category" => $category;
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
         //validation
        $request->validate($request,[
            'title' =>'required'
        ]); 
        // update category
        $title = $request->title; 
        Category::update([
            'title' =>$title,
            'slug' =>Str::slug($title)
        ]);
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "catégorie modifiée avec succés"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
         
        //delete category
        $category->delete();
        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "catégorie supprimée avec succés"
        ]);
    }
}
