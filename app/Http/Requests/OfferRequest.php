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
            'name'=> 'required|max:100|unique:offers,name',
            'price'=> 'required|numeric',
            'details'=> 'required|max:200',
        ];
    }

    public function messages(){
        return [
            "name.required" => __('alerts.OfferNameRequired'),
            "name.max" => trans('alerts.OfferNameMAx'),
            "price.required" => __('alerts.OfferPriceRequired'),
            "price.numeric" => __('alerts.OfferPriceNumeric'),
            "details.required" => __('alerts.OfferDetailsRequired'),
            "details.max" => __('alerts.OfferDetailsMax'),
        ];
    }
}
