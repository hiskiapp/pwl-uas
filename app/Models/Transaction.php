<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'total_price',
        'total_item',
        'total_weight',
        'payment_method_id',
        'status',
        'address1',
        'address2',
        'postcode',
        'city_id',
        'province_id',
        'country',
        'shipping_name',
        'shipping_service',
        'shipping_cost',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function transactionItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = 'INV' . time() . str_pad(Transaction::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
