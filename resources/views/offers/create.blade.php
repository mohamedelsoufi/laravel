@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col text-center">
                    Add your offer
                </div>
            </div>
            @if(Session::has('success'))
            <div class="row">
                <div class="col text-center">

                    <div class="alert alert-success" role="alert">
                        A simple success alert—check it out!
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{route('offers.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="offerName" class="form-label">Offer Name</label>
                            <input type="text" name="name" class="form-control" id="offerName" aria-describedby="offerName">
                            @error('name')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="offerPrice" class="form-label">Offer Price</label>
                            <input type="text" name="price" class="form-control" id="offerPrice" aria-describedby="offerPrice">
                            @error('price')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="offerDetails" class="form-label">Offer Details</label>
                            <input type="text" name="details" class="form-control" id="offerDetails" aria-describedby="offerDetails">
                            @error('details')
                            <small class="form-text text-danger"> {{$message}} </small>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Save Offer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
