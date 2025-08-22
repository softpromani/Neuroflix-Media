<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'discounted_price',
        'image',
        'short_description',
        'long_description',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'discount_percentage',
        'whatsapp_message'
    ];
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discounted_price && $this->price > 0) {
            return round((($this->price - $this->discounted_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getWhatsappMessageAttribute()
    {
        $message = "Hi! I'm interested in purchasing: " . $this->name;
        $message .= "\nPrice: ₹" . $this->discounted_price ?? $this->price;
        $message .= "\nProduct URL: " . route('products.show', $this->id);
        return urlencode($message);
    }
}
