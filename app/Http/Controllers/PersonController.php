<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function registrationForm()
    {
        return view('member.memberreg');
    }

    public function register(Request $request)
    {
        $person = new Person();
        $person->name = $request->membername;
        $person->email = $request->email;
        $person->contactno = $request->contactno;

        if($person->save()) {  
            return redirect('/')->with('success', 'Member added!');     
        }
        else {
            return redirect('/')->with('fail', 'Member couldnot be added!');    
        }
        
    }
}
