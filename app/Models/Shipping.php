<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

		protected $fillable = [
			'city',
			'street_nb',
			'street',
			'additional_info',
			'nickname',
			'user_id'
		];

		public function users()
		{
			return $this->belongsTo(User::class);
		}
}
