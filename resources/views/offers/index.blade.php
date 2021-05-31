@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @if(Session::has('error'))
                <div class="col text-center">
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                </div>
                @endif

                    @if(Session::has('success'))
                        <div class="col text-center">
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                            </div>
                        </div>
                    @endif
            </div>
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
                            <th scope="col">IM</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                        <tr>
                            <th scope="row">{{$offer -> id}}</th>
                            <td>{{$offer -> name}}</td>
                            <td>{{$offer -> price}}</td>
                            <td>{{$offer -> details}}</td>
                            <td>
                                <a href="{{URL('offers/edit/'.$offer->id)}}" class="btn btn-sm btn-outline-primary">  {{__('statics.edit')}}  </a>
                                <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-sm btn-outline-danger">  {{__('statics.delete')}}  </a>
                            </td>
                            <td><img style="max-width: 80px;" src="{{asset('images/offers/' . $offer -> image )}}"></td>
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
