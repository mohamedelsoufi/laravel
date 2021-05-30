@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col text-center">
                    <table class="table table-dark table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('statics.OfferName')}}</th>
                            <th scope="col">{{__('statics.OfferPrice')}}</th>
                            <th scope="col">{{__('statics.OfferDetails')}}</th>
                            <th scope="col">{{__('statics.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                        <tr>
                            <th scope="row">{{$offer -> id}}</th>
                            <td>{{$offer -> name}}</td>
                            <td>{{$offer -> price}}</td>
                            <td>{{$offer -> details}}</td>
                            <td><a href="{{URL('offers/edit/'.$offer->id)}}" class="btn btn-primary">  {{__('statics.edit')}}  </a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
