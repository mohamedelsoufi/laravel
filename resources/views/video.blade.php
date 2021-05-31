@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col text-center">
                    Video Viewer ({{$video -> viewers}})
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/GiNWNd_Qpnk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
