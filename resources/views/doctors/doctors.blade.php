@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col text-center">
                        Doctors
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">HospitaIS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($doctors) && $doctors -> count() > 0)
                                @foreach($doctors as $doctor)
                                    <tr>
                                        <th scope="row">{{$doctor -> id}}</th>
                                        <td>{{$doctor -> name}}</td>
                                        <td>{{$doctor -> title}}</td>
                                        <td>{{$doctor -> hospital_id}}</td>
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
