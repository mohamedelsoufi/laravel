<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {

        return view('ajaxOffers.create');
    }

    public function store(OfferRequest $request)
    {
        $file_name = $this->saveImages($request->image, 'images/offers');
        $offer = Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'image' => $file_name,
        ]);
        if ($offer) {
            return response()->json([
                "status" => true,
                "msg" => "Saved Successfully ya basha",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => "Failed while Saving ya basha",
            ]);
        }
    }

    public function index()
    {
        $offers = Offer::select('id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
            'image')->limit(3)->get();
        return view('ajaxOffers.index', compact('offers'));
    }

    public function delete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.Offer error')]);
        $offer->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Deleted Successfully',
            'id' => $request->id,
        ]);
    }

    public function edit(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer) {
            return response()->json([
                "status" => false,
                "msg" => "Failed while Saving ya basha",
            ]);
        }
        $offerWithID = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en')->find($request->id);
        return view('ajaxOffers.edit', compact('offerWithID'));
    }

    public function update(Request $request)
    {
        //check if id inserted
        $offer = Offer::find($request->id);
        if (!$offer)
            return response()->json([
                "status" => false,
                "msg" => "Failed while Saving ya basha",
            ]);
        $offer->update($request->all());

        return response()->json([
            "status" => true,
            "msg" => "Saved Successfully ya basha",
        ]);

    }
}
