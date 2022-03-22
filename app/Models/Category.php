<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'slug',
	];

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function photos()
	{
		return $this->morphMany(Photo::class, 'imageable');
	}
}
