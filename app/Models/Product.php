<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // TAMBAHKAN 'stock' DI SINI
    protected $fillable = ['name', 'slug', 'price', 'stock', 'category_id'];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer' // Tambahkan cast ini agar data selalu dibaca sebagai angka
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            // Update slug otomatis jika nama berubah
            $model->slug = Str::slug($model->name);
        });
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
