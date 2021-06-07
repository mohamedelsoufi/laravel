@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col text-center">
                        {{__('statics.EditOffer')}}
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-success" role="alert" id="success_msg" style="display: none">
                            {{__('statics.OfferUpdated')}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-danger" role="alert" id="error_msg" style="display: none">
                            {{__('statics.OfferError')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="POST" id="offer_form" action="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$offerWithID -> id}}">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">{{__('statics.OfferName_ar')}}</label>
                                <input type="text" name="name_ar" value="{{$offerWithID -> name_ar}}"
                                       class="form-control" id="name_ar" aria-describedby="name_ar">

                                <small id="name_ar_error" class="form-text text-danger"> </small>

                            </div>

                            <div class="mb-3">
                                <label for="name_en" class="form-label">{{__('statics.OfferName_en')}}</label>
                                <input type="text" name="name_en" value="{{$offerWithID->name_en}}" class="form-control"
                                       id="name_en" aria-describedby="name_en">

                                <small id="name_en_error" class="form-text text-danger"> </small>

                            </div>

                            <div class="mb-3">
                                <label for="offerPrice" class="form-label">{{__('statics.OfferPrice')}}</label>
                                <input type="text" name="price" value="{{$offerWithID->price}}" class="form-control"
                                       id="offerPrice" aria-describedby="offerPrice">

                                <small id="price_error" class="form-text text-danger"> </small>

                            </div>

                            <div class="mb-3">
                                <label for="details_ar" class="form-label">{{__('statics.OfferDetails_ar')}}</label>
                                <input type="text" name="details_ar" value="{{$offerWithID->details_ar}}"
                                       class="form-control" id="details_ar" aria-describedby="details_ar">

                                <small id="details_ar_error" class="form-text text-danger"> </small>

                            </div>

                            <div class="mb-3">
                                <label for="details_en" class="form-label">{{__('statics.OfferDetails_en')}}</label>
                                <input type="text" name="details_en" value="{{$offerWithID->details_en}}"
                                       class="form-control" id="details_en" aria-describedby="details_en">

                                <small id="details_en_error" class="form-text text-danger"> </small>

                            </div>


                            <button id="update_offer" class="btn btn-primary">{{__('statics.Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            let formData = new FormData($('#offer_form')[0]);
            $.ajax({
                type: "post",
                enctype: 'multipart/form-data',
                url: "{{route('ajaxOffers.update')}}",
                data: formData,

                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                },
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });

    </script>
@stop
