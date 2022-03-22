<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
  use HasFactory;

	protected $fillable = [
		'user_id',
		'product_id',
		'product_qty'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
