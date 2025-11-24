// 025 app/Models/InvoiceItem.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'description', 'amount', 'quantity', 'stripe_price_id'];
}