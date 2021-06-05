@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col text-center">
                        Hospitals
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($hospitals) && $hospitals->count() >0)
                                @foreach($hospitals as$hospital)
                                    <tr>
                                        <th scope="row">{{$hospital -> id}}</th>
                                        <td>{{$hospital -> name}}</td>
                                        <td>{!! $hospital -> address !!}</td>
                                        <td><a href="{{route('hospital.doctors',$hospital->id)}}"
                                               class="btn btn-primary btn-sm">View</a></td>
                                        <td><a href="{{route('hospital.delete',$hospital->id)}}"
                                               class="btn btn-danger btn-sm">Delete</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
