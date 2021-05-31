<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\OfferTrait;

class CrudController extends Controller
{
    use OfferTrait;

    public function getOffers()
    {
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
        $file_name = $this -> saveImages($request -> image, 'images/offers');
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'image' => $file_name,
        ]);
        return redirect()->back()->with(['success' => 'Created Successfully']);
    }

    public function index()
    {
        $offers = Offer::select('id',
            'name_'.  LaravelLocalization::getCurrentLocale() .' as name',
            'price',
            'details_'.  LaravelLocalization::getCurrentLocale() .' as details',
            'image')-> get();
        return view('offers.index', compact('offers'));
    }

    public function edit($id){
//        Offer::findOrFail($id);
        $offer =Offer::find($id);
        if (!$offer){
            return redirect()->back();
        }
        $offerWithID = Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($id);
        return view('offers.edit',compact('offerWithID'));
    }
    public function update(OfferRequest $request, $id){
        //check if id inserted
        $offer = Offer::find($id);
        if(!$offer)
            return redirect()->back();
        $offer -> update($request->all());
        return redirect()->back()->with(['success'=>'Offer Updated Successfully']);
    }

    public function delete($id){
        $offer = Offer::find($id);
        if (!$offer)
            return redirect()->back()->with(['error'=> __('messages.Offer error')]);
        $offer -> delete();
        return redirect()->route('offers.index',$id)->with(['success'=> __('messages.deleted success')]);
    }

    public function getVideo(){
        $video = Video::first();
        event(new VideoViewer($video));
        return view('video',compact('video'));
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
