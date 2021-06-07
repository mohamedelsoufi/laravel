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
                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-success" role="alert" id="success_msg" style="display: none">
                            {{__('statics.OfferSaved')}}
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
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">{{__('statics.OfferName_ar')}}</label>
                                <input type="text" name="name_ar" class="form-control" id="name_ar"
                                       aria-describedby="name_ar">

                                <small id="name_ar_error" class="form-text text-danger"> </small>
                            </div>

                            <div class="mb-3">
                                <label for="name_en" class="form-label">{{__('statics.OfferName_en')}}</label>
                                <input type="text" name="name_en" class="form-control" id="name_en"
                                       aria-describedby="name_en">

                                <small id="name_en_error" class="form-text text-danger"> </small>
                            </div>

                            <div class="mb-3">
                                <label for="offerPrice" class="form-label">{{__('statics.OfferPrice')}}</label>
                                <input type="text" name="price" class="form-control" id="offerPrice"
                                       aria-describedby="offerPrice">

                                <small id="price_error" class="form-text text-danger"> </small>
                            </div>

                            <div class="mb-3">
                                <label for="details_ar" class="form-label">{{__('statics.OfferDetails_ar')}}</label>
                                <input type="text" name="details_ar" class="form-control" id="details_ar"
                                       aria-describedby="details_ar">

                                <small id="details_ar_error" class="form-text text-danger"> </small>
                            </div>

                            <div class="mb-3">
                                <label for="details_en" class="form-label">{{__('statics.OfferDetails_en')}}</label>
                                <input type="text" name="details_en" class="form-control" id="details_en"
                                       aria-describedby="details_en">

                                <small id="details_en_error" class="form-text text-danger"> </small>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{__('statics.image')}}</label>
                                <input type="file" name="image" class="form-control" id="image"
                                       aria-describedby="image">

                                <small id="image_error" class="form-text text-danger"> </small>

                            </div>


                            <button id="save_offer" class="btn btn-primary">{{__('statics.OfferSave')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            var formData = new FormData($('#offer_form')[0]);
            $.ajax({
                type: "post",
                enctype: 'multipart/form-data',
                url: "{{route('ajaxOffers.store')}}",
                data: formData,

                processData: false,
                contentType: false,
                cache: false,
                {{--data : {--}}
                    {{--    '_token': "{{csrf_token()}}",--}}
                    {{--    'name_ar': $("input[name='name_ar']").val(),--}}
                    {{--    'name_en': $("input[name='name_en']").val(),--}}
                    {{--    'price': $("input[name='price']").val(),--}}
                    {{--    'details_ar': $("input[name='details_ar']").val(),--}}
                    {{--    'details_en': $("input[name='details_en']").val(),--}}
                    {{--},--}}
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                        $("#offer_form")[0].reset();
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
