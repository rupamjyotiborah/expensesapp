<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;
    protected $fillable = ['expenseid', 'personid', 'expensetypeid', 'amount', 'expensemembername'];
    protected $table = 'shares';

    public function personid()
    {
        return $this->belongsTo(Person::class, 'foreign_key');
    }
    public function expensetypeid()
    {
        return $this->belongsTo(ExpenseType::class, 'foreign_key');
    }
    public function expenseid()
    {
        return $this->belongsTo(Expense::class, 'foreign_key');
    }
}
