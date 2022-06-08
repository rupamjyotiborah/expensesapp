<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['personid', 'amount'];
    protected $table = 'expenses';

    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
