<?php

namespace App\Models\Custom;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(related: Payment::class);
    }
}
