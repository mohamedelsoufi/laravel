<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers(){
        return Offer::get();
    }

//    public function store(){
//        Offer::create([
//            'name' => 'offer3',
//            'price' => '5000',
//            'details' => 'offer details',
//        ]);
//    }

    public function create()
    {
        return view('offers.create');
    }
    public function store(Request $request)
    {
        //validate data
        $roles = $this->getRoles();

        $messages = $this->getMessages();

        $validation = Validator::make($request->all(), $roles,$messages);

        if ($validation -> fails()){
            // return $validation ->errors();
            return redirect()->back()->withErrors($validation)->withInputs($request->all());
        }
        // inserting data to Db
        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return redirect()->back()->with(['success'=>'Created Successfully']);
    }
    protected function getMessages(){
        return [
            "name.required" => "This Fieled is required ya beeh",
            "name.max" => "you have reached max characters ya beeh",
            "price.required" => "This Fieled is required ya beeh",
            "price.numeric" => "This Fieled is Numirecal ya beeh",
            "details.required" => "This Fieled is required ya beeh",
            "details.max" => "you have reached max characters ya beeh",
        ];
    }

    protected function getRoles(){
        return [
            'name'=> 'required|max:100|unique:offers,name',
            'price'=> 'required|numeric',
            'details'=> 'required|max:200',
        ];
    }
}
