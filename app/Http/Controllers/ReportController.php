<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Expense;
use App\Models\Share;
use DB;

class ReportController extends Controller
{
    public function showForm()
    {
        $members = Person::all();
        return view('report.form', compact('members'));    
    }

    public function getexpenses(Request $request)
    {
        $memberid = $request->memberid;
        $members = Person::all();
        $totalexpenses = Expense::where('personid',$memberid)->get();
        $flag = 0;
        $str = array();        
        foreach($totalexpenses as $t) 
        {
            array_push($str,$t->id);
        }
        $totalBalances = Share::where('personid',$memberid)->whereNotIn('expenseid',$str)->get();

        return view('report.form', compact('members','totalexpenses','totalBalances'));
    }
}
