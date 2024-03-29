<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
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
        return view("menus.index")->with([
            "menus" => Menu::paginate(5)
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
         return view("menus.create")->with([
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        //
        //validation
        $this->validate($request, [
            "title" => "required|min:3|unique:menus,title",
            "description" => "required|min:5",
            "image" => "required|image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "category_id" => "required|numeric",
        ]);

        //store data
        if ($request->hasFile("image")) {
            $file = $request->image;
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'), $imageName);
            $title = $request->title;
            Menu::create([
                "user_id"=>Auth::user()->id,
                "title" => $title,
                "slug" => Str::slug($title),
                "description" =>  $request->description,
                "price" =>  $request->price,
                "category_id" =>  $request->category_id,
                "image" =>  $imageName,
            ]);
            //redirect user
            return redirect()->route("menus.index")->with([
                "success" => "menu ajouté avec succés"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
        return view("menus.show")->with([
            "menu" => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        return view("menus.edit")->with([
            "categories" => Category::all(),
            "menu" => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
        //validation
        $this->validate($request, [
            "title" => "required|min:3|unique:menus,title," . $menu->id,
            "description" => "required|min:5",
            "image" => "image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "category_id" => "required|numeric",
        ]);
        //store data
        if ($request->hasFile("image")) {

            $file=$request->image;
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'), $imageName);
            $menu->image =$imageName;
        }
            $title = $request->title;
            $menu->update([
                "user_id"=>Auth::user()->id,
                "title" => $title,
                "slug" => Str::slug($title),
                "description" =>  $request->description,
                "price" =>  $request->price,
                "category_id" =>  $request->category_id,
                "image" => $imageName,
            ]);
            //redirect user
            return redirect()->route("menus.index")->with([
                "success" => "menu modifié avec succés"
            ]);
        // } else {
        //     $title = $request->title;
        //     $menu->update([
        //         "title" => $title,
        //         "slug" => Str::slug($title),
        //         "description" =>  $request->description,
        //         "price" =>  $request->price,
        //         "category_id" =>  $request->category_id
        //     ]);
        //     //redirect user
        //     return redirect()->route("menus.index")->with([
        //         "success" => "menu modifié avec succés"
        //     ]);
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {

        //remove image
        // unlink(public_path('images/menus/' . $menu->image));
        $menu->delete();
        //redirect user
        return redirect()->route("menus.index")->with([
            "success" => "menu supprimé avec succés"
        ]);
    }
}
