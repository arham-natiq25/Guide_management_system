<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStripe extends Model
{
    use HasFactory;
    protected $table = 'payment_stripes' ;
    protected $primaryKey = 'id';

    protected $fillable = [
        'payment_token'
    ];
}
