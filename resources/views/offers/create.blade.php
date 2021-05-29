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
                    <form method="POST" action="{{route('offers.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="offerName" class="form-label">{{__('statics.OfferName')}}</label>
                            <input type="text" name="name" class="form-control" id="offerName" aria-describedby="offerName">
                            @error('name')
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
                            <label for="offerDetails" class="form-label">{{__('statics.OfferDetails')}}</label>
                            <input type="text" name="details" class="form-control" id="offerDetails" aria-describedby="offerDetails">
                            @error('details')
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
