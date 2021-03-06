@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col text-center">
                    {{__('statics.AddOffer')}}
                </div>
            </div>
            @if(Session::has('success'))
            <div class="row">
                <div class="col text-center">

                    <div class="alert alert-success" role="alert">
                        {{__('statics.OfferSaved')}}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name_ar" class="form-label">{{__('statics.OfferName_ar')}}</label>
                            <input type="text" name="name_ar" class="form-control" id="name_ar" aria-describedby="name_ar">
                            @error('name_ar')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">{{__('statics.OfferName_en')}}</label>
                            <input type="text" name="name_en" class="form-control" id="name_en" aria-describedby="name_en">
                            @error('name_en')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="offerPrice" class="form-label">{{__('statics.OfferPrice')}}</label>
                            <input type="text" name="price" class="form-control" id="offerPrice" aria-describedby="offerPrice">
                            @error('price')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="details_ar" class="form-label">{{__('statics.OfferDetails_ar')}}</label>
                            <input type="text" name="details_ar" class="form-control" id="details_ar" aria-describedby="details_ar">
                            @error('details_ar')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="details_en" class="form-label">{{__('statics.OfferDetails_en')}}</label>
                            <input type="text" name="details_en" class="form-control" id="details_en" aria-describedby="details_en">
                            @error('details_en')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{__('statics.image')}}</label>
                            <input type="file" name="image" class="form-control" id="image" aria-describedby="image">
                            @error('image')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">{{__('statics.OfferSave')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
