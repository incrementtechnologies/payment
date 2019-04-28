<?php

namespace Increment\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;
class PaymentMethod extends APIModel
{
    protected $table = 'payment_methods';
    protected $fillable = ['account_id', 'payload', 'payload_value', 'status'];
}
