<?php

namespace App\Models;

use App\Models\Custom\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(related: Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
