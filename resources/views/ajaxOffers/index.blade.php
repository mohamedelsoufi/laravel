@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-success" role="alert" id="success_msg" style="display: none">
                            {{__('statics.OfferDeletedSuc')}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-danger" role="alert" id="error_msg" style="display: none">
                            {{__('statics.OfferDeletedErr')}}
                        </div>
                    </div>
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
                                <tr class="offer_Row{{$offer -> id}}">
                                    <th scope="row">{{$offer -> id}}</th>
                                    <td>{{$offer -> name}}</td>
                                    <td>{{$offer -> price}}</td>
                                    <td>{{$offer -> details}}</td>
                                    <td>
                                        <a href="{{route('ajaxOffers.edit',$offer->id)}}"
                                           class="btn btn-sm btn-outline-primary">  {{__('statics.edit')}}  </a>
                                        <a href="" offer_id="{{$offer->id}}"
                                           class="delete_btn btn btn-sm btn-outline-danger">  {{__('statics.delete')}}  </a>
                                    </td>
                                    <td><img style="max-width: 80px;"
                                             src="{{asset('images/offers/' . $offer -> image )}}"></td>
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

@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            let offerId = $(this).attr('offer_id');
            $.ajax({
                type: "post",
                url: "{{route('ajaxOffers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': offerId,
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    $('.offer_Row' + data.id).remove();
                },
                error: function (reject) {
                    $('#error_msg').show();
                }
            });
        });
    </script>
@stop
