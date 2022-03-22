<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', ['except' => [
			'show', 'view'
		]]);
	}

	// List of Products in Table
	public function index(User $user)
	{
		//Check if admin
		$this->authorize('view', $user);

		$products = Product::with('photos')->get();
		$categories = Category::all();

		return view('admin.product', compact('products','categories'));
	}

	public function create(User $user)
	{
		//Check if admin
		$this->authorize('view', $user);
		return view('product.create');
	}

	public function store(Request $request, User $user)
	{
		if (!$request->hasFile('image')) {
			return response(['msg' => 'Une image est requise'], 400);
		}

		//Check if admin
		$this->authorize('view', $user);

		// Validate the forms
		$data = $request->validate([
			'name' => 'required|max:255',
			'price' => 'required|numeric',
			'qty' => 'required|numeric',
			'description' => 'required',
			'category' => 'required',
			'image' => 'required'
		]);

		$images = array();

		$files = $request->file('image');

		foreach ($files as $file) {

			$dir = 'img\\';
			//save the img
			$img = time() . '.' . $file->extension();
			$file->move($dir, $img);
			array_push($images, $dir . $img);
		}

		// IF validation returns no error create and insert new product to the database
		$product = Product::create([
			'name' => $request->name,
			'price' => $request->price,
			'qty' => $request->qty,
			'description' => $request->description,
			'category' => $request->category,
			'slug' => Str::slug($request->name)
		]);

		foreach ($images as $url) {
			Photo::create([
				'url' => $url,
				'imageable_id' => $product->id,
				'imageable_type' => 'App\Models\Product'
			]);
		}
		// redirect
		return response()->json(['msg' => 'success']);
	}


	public function edit(Request $request, Product $product)
	{
		//Check if admin
		$this->authorize('view', auth()->user());

		$product = Product::with('photos')->find($product->id);

		return response()->json($product);
	}

	public function update(ProductRequest $request, Product $product)
	{
		$id = $product->id;
		$this->authorize('update', auth()->user());
		$slug = Str::slug($request->name);

		if ($request->hasFile('image')) {

			// Remove All Photos Associated in product
			$photos = $product->photos;
			foreach ($photos as $photo) {
				Photo::destroy($photo->id);
			}

			$files = $request->file('image');
			foreach ($files as $file) {
				$dir = 'img\\';
				//save the img
				$img = time() . '.' . $file->extension();
				$file->move($dir, $img);
				Photo::create([
					'url' => $dir . $img,
					'imageable_id' => $product->id,
					'imageable_type' => 'App\Models\Product'
				]);
			}
		}

		$data = array_merge($request->except('image'), ['slug' => $slug]);

		$product->update($data);

		return response()->json(['status' => 'Le produit a été mis a jour', 'msg' => 'success']);
	}

	public function destroy(Product $product, User $user)
	{
		//Check if authorize to delete
		$this->authorize('view', $user);

		$photos = $product->photos;
		foreach ($photos as $photo) {
			Photo::destroy($photo->id);
		}

		$product->destroy($product->id);


		return back()->with('status', 'Le produit a été supprimé');
	}


	public function show($id, $slug = '')
	{
		$product = Product::with('photos')->findOrFail($id);

		//If slug is empty or wrong
		if (empty($slug) || $product->slug != $slug) {
			return redirect()->route('product.show', ['product' => $product, 'slug' => $product->slug]);
		}

		session()->forget('thankyou');
		$isAuthenticated = (Auth::check()) ? Auth::id() : '';


		return view('product.show', compact('product'));
	}

	// All Products
	public function view()
	{
		$products = Product::with('photos')->paginate(15);

		return view('product.all-product', compact('products'));
	}
}
