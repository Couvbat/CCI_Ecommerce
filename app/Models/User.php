<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
				'lastName',
        'email',
				'phone',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


		/**
     *
     *  A user can have many products in a cart
     *
     * you may also customize the column names of the keys on the table
     * by passing additional arguments to the belongsToMany method
     *
     * The second argument is the name of the table
     * The third argument is the foreign key name of the model on which you are defining the relationship
     * The fourth argument is the foreign key name of the model that you are joining to
     * belongsToMany(Product::class, 'carts', 'user_id', 'product_id');
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders', 'user_id', 'product_id')
            ->withPivot('id', 'amount', 'qty', 'transaction_no', 'tax');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function realUser($id)
    {
        return auth()->user()->id === $id;
    }
}
