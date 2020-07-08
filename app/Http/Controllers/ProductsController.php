<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Image;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(request('q'))) {
            return view('products.index', ['products' => Product::paginate(10) ]);
        } else{
            return view('products.index', ['products' => Product::query()->whereLike('name', request('q'))->paginate(10) ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', ['categories' => Category::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'barcode' => 'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image')->store('products', 'public');
        
        Image::make(public_path("storage/{$image}"))->fit(200)->save();

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'barcode' => $request->barcode,
            'image' => 'storage/' . $image,
            'user_id' => auth()->user()->id
        ]);
            
        return redirect()->route('products.index')->with('status', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.show', ['product' => Product::findOrFail($id) ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();

        return redirect()->route('products.index')->with('status', 'Berhasil menghapus data');
    }
}
