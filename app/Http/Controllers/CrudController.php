<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
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
    public function store(OfferRequest $request)
    {
        //validate data
//        $roles = $this->getRoles();
//
//        $messages = $this->getMessages();
//
//        $validation = Validator::make($request->all(), $roles,$messages);
//
//        if ($validation -> fails()){
//            // return $validation ->errors();
//            return redirect()->back()->withErrors($validation)->withInputs($request->all());
//        }
        // inserting data to Db
        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return redirect()->back()->with(['success'=>'Created Successfully']);
    }
//    protected function getMessages(){
//        return [
//            "name.required" => __('alerts.OfferNameRequired'),
//            "name.max" => trans('alerts.OfferNameMAx'),
//            "price.required" => __('alerts.OfferPriceRequired'),
//            "price.numeric" => __('alerts.OfferPriceNumeric'),
//            "details.required" => __('alerts.OfferDetailsRequired'),
//            "details.max" => __('alerts.OfferDetailsMax'),
//        ];
//    }
//
//    protected function getRoles(){
//        return [
//            'name'=> 'required|max:100|unique:offers,name',
//            'price'=> 'required|numeric',
//            'details'=> 'required|max:200',
//        ];
//    }
}
