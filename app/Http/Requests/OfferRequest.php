<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'=> 'required|max:100|unique:offers,name_ar',
            'name_en'=> 'required|max:100|unique:offers,name_en',
            'price'=> 'required|numeric',
            'details_ar'=> 'required|max:200',
            'details_en'=> 'required|max:200',
        ];
    }

    public function messages(){
        return [
            "name_ar.required" => __('alerts.OfferNameRequired'),
            "name_en.required" => __('alerts.OfferNameRequired'),
            "name_ar.max" => trans('alerts.OfferNameMAx'),
            "name_en.max" => trans('alerts.OfferNameMAx'),
            "price.required" => __('alerts.OfferPriceRequired'),
            "price.numeric" => __('alerts.OfferPriceNumeric'),
            "details_ar.required" => __('alerts.OfferDetailsRequired'),
            "details_en.required" => __('alerts.OfferDetailsRequired'),
            "details_ar.max" => __('alerts.OfferDetailsMax'),
            "details_en.max" => __('alerts.OfferDetailsMax'),
        ];
    }
}
