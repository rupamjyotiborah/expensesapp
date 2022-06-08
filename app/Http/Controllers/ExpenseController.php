<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\Person;
use App\Models\Expense;
use App\Models\Share;

class ExpenseController extends Controller
{
    public function showForm()
    {
        $expensetypes = ExpenseType::all();
        $members = Person::all();
        return view('expense.showform', compact('expensetypes','members'));
    }

    public function addExpense(Request $request)
    {
        $personid = $request->personid;
        $exptype = $request->exptype;
        $sharewith = $request->sharewith;
        $sharevalue = $request->sharevalue;
        $amount = $request->amount;
        $memberInfo = Person::where('id',$personid)->first();
        $t = "";
        if($exptype == 1)
        {
            if(($amount % count($sharewith)) == 0)
            {
                $sharedAmount = $amount / count($sharewith);
                $data["personid"] = $personid;
                $data["amount"] = $amount;
                $insertedData = Expense::create($data);
                for($i = 0; $i < count($sharewith); $i++) 
                {
                    $share = new Share();
                    $share->expenseid = $insertedData->id;
                    $share->personid = $sharewith[$i]; 
                    $share->expensetypeid = $exptype; 
                    $share->amount = $sharedAmount; 
                    $share->expensemembername = $memberInfo->name;
                    $share->save();  
                }
                return redirect('/')->with('success', 'Expense added and Shared Equally!');    
            }
            else {
                $flag = 0;
                $totalIndividualShare = 0;
                $data["personid"] = $personid;
                $data["amount"] = $amount;
                $insertedData = Expense::create($data);
                foreach($sharewith as $r) 
                {
                    $individualShare = round($amount/count($sharewith),2);
                    $totalIndividualShare += $individualShare;
                }
                if($totalIndividualShare < $amount) {
                    $difference = $amount - $totalIndividualShare;
                    foreach($sharewith as $r)
                    {
                        $sharedAmount = round($amount/count($sharewith),2);
                        if($r == $personid) {
                            $share = new Share();
                            $share->expenseid = $insertedData->id;
                            $share->personid = $personid; 
                            $share->expensetypeid = $exptype; 
                            $share->amount = $sharedAmount + $difference;
                            $share->expensemembername = $memberInfo->name; 
                            $share->save();
                        }
                        else {
                            $share = new Share();
                            $share->expenseid = $insertedData->id;
                            $share->personid = $r; 
                            $share->expensetypeid = $exptype; 
                            $share->amount = $sharedAmount;
                            $share->expensemembername = $memberInfo->name; 
                            $share->save();    
                        }
                    }
                    return redirect('/')->with('success', 'Expense added and Shared Equally!');
                }
                if($totalIndividualShare > $amount) {
                    $difference = $totalIndividualShare - $amount;
                    foreach($sharewith as $r)
                    {
                        $sharedAmount = round($amount/count($sharewith),2);
                        if($r == $personid) {
                            $share = new Share();
                            $share->expenseid = $insertedData->id;
                            $share->personid = $personid; 
                            $share->expensetypeid = $exptype; 
                            $share->amount = $sharedAmount - $difference;
                            $share->expensemembername = $memberInfo->name; 
                            $share->save();
                        }
                        else {
                            $share = new Share();
                            $share->expenseid = $insertedData->id;
                            $share->personid = $personid; 
                            $share->expensetypeid = $exptype; 
                            $share->amount = $sharedAmount; 
                            $share->expensemembername = $memberInfo->name;
                            $share->save();    
                        }
                    }
                    return redirect('/')->with('success', 'Expense added and Shared Equally!');
                }
            }            
        }
        if($exptype == 2)
        {
            $totalAmount = 0;
            for($i = 0; $i < count($sharevalue); $i++)
            {
                $totalAmount += $sharevalue[$i];
            }
            if($amount != $totalAmount){
                return redirect()->back()->with('errMsg', 'Sum of shares is not equal to total amount');
            }
            
            $data["personid"] = $personid;
            $data["amount"] = $amount;
            $insertedData = Expense::create($data);
            for($i = 0; $i < count($sharewith); $i++) 
            {
                $share = new Share();
                $share->expenseid = $insertedData->id;
                $share->personid = $sharewith[$i]; 
                $share->expensetypeid = $exptype; 
                $share->amount = $sharevalue[$i]; 
                $share->expensemembername = $memberInfo->name;
                $share->save();  
            }
            return redirect('/')->with('success', 'Expense added!');           
        }

        if($exptype == 3)
        {
            $totalPercentage = 0;
            for($i = 0; $i < count($sharevalue); $i++)
            {
                $totalPercentage += $sharevalue[$i];
            }
            if($totalPercentage != 100){
                return redirect()->back()->with('errMsg', 'Sum of share of percentage should be 100');
            }
            
            $data["personid"] = $personid;
            $data["amount"] = $amount;
            $insertedData = Expense::create($data);
            for($i = 0; $i < count($sharewith); $i++) 
            {
                $calculatedAmount = ($sharevalue[$i] / 100) * $amount;
                $share = new Share();
                $share->expenseid = $insertedData->id;
                $share->personid = $sharewith[$i]; 
                $share->expensetypeid = $exptype; 
                $share->amount = $calculatedAmount; 
                $share->expensemembername = $memberInfo->name;
                $share->save();  
            }
            return redirect('/')->with('success', 'Expense added!');           
        }

    }
}
