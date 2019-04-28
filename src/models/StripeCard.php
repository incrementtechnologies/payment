<?php

namespace Increment\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;
class StripeCard extends APIModel
{
    protected $table = 'stripe_cards';
    protected $fillable = ['account_id', 'brand', 'last4', 'exp_year', 'exp_month', 'source', 'customer', 'status'];
}
