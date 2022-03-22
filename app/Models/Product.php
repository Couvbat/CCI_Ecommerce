<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'price',
		'qty',
		'description',
		'category',
		'slug',
	];

	public function getPriceAttribute()
	{

		return number_format(($this->attributes['price']), 2, '.', ',');
	}

	// Update Product Qty
	public function updateProductQuantity($data)
	{
		try {
			foreach ($data['content'] as $key => $value) {

				$product = Product::findOrFail($value->id);

				$product->update([
					'qty' => ($product->qty) - ($value->qty)
				]);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			die('Quelquechose c\'est mal passé' . $e->getMessage());
		}
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function carts()
	{
		return $this->belongsToMany(Cart::class)
			->withTimestamps();
	}

	public function ingredients()
	{
		return $this->belongsToMany(Ingredient::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function photos()
	{
		return $this->morphMany(Photo::class, 'imageable');
	}
}
