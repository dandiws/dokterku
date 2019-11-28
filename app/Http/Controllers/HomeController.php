<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = User::where('type','doctor')->get();
        return view('home', ['doctors'=>$doctors]);
    }

    public function search(Request $req)
    {
        $name = $req->get('doctor_name')?$req->get('doctor_name'):'';
        $doctors = User::where('type','doctor')->where('name', 'like', '%' . $name . '%')->get();
        if($req->get('specialization_id')){
            $doctors = $doctors->filter(function($val,$key) use($req){
                if($val->doctorDetails()){
                    return $val->doctorDetails()->specialization_id==$req->get('specialization_id');
                }
                return false;
            });
        }
        

        return view('home', ['doctors'=>$doctors]);
    }
}
