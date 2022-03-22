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
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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

		$categories = Category::with('photos')->get();

		return view('admin.categories', compact('categories'));
	}

	public function create(User $user)
	{
		//Check if admin
		$this->authorize('view', $user);
		return view('category.create');
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
			'description' => 'required',
			'slug',
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
		$category = Category::create([
			'name' => $request->name,
			'description' => $request->description,
			'category' => $request->category,
			'slug' => Str::slug($request->name)
		]);

		foreach ($images as $url) {
			Photo::create([
				'url' => $url,
				'imageable_id' => $category->id,
				'imageable_type' => 'App\Models\Category'
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

	public function update(CategoryRequest $request, Category $category)
	{
		$id = $category->id;
		$this->authorize('update', auth()->user());
		$slug = Str::slug($request->name);

		if ($request->hasFile('image')) {

			// Remove All Photos Associated in Category
			$photos = $category->photos;
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
					'imageable_id' => $category->id,
					'imageable_type' => 'App\Models\Category'
				]);
			}
		}

		$data = array_merge($request->except('image'), ['slug' => $slug]);

		$category->update($data);

		return response()->json(['status' => 'La categorie a été mis a jour', 'msg' => 'success']);
	}

	public function destroy(Category $category, User $user)
	{
		//Check if authorize to delete
		$this->authorize('view', $user);

		$photos = $category->photos;
		foreach ($photos as $photo) {
			Photo::destroy($photo->id);
		}

		$category->destroy($category->id);


		return back()->with('status', 'La categorie a été supprimé');
	}


	public function show($id, $slug = '')
	{
		$category = Category::with('photos')->findOrFail($id);

		//If slug is empty or wrong
		if (empty($slug) || $category->slug != $slug) {
			return redirect()->route('product.show', ['product' => $category, 'slug' => $product->slug]);
		}

		session()->forget('thankyou');
		$isAuthenticated = (Auth::check()) ? Auth::id() : '';


		return view('category.show', compact('categories'));
	}

	// All Products
	public function view()
	{
		$categories = Category::with('photos')->paginate(15);

		return view('product.all-product', compact('categories'));
	}
}
