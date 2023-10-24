<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $appends ='total_price';
	protected $table ='order_items';
    protected $fillable =[
        'price',
        'quantity',
        'product_id',
        'order_id',
    ];

    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

	    public function total()
    {
        return $this->quantity * $this->price;
    }
		public function formattedTotal()
    {
        return $this->total();
	}

    public function scopeByMonthYear($query, $year, $month) {
        return $query->whereYear('created_at', $year)
                     ->whereMonth('created_at', $month);
    }
}
