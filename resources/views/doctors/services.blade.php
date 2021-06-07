@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col text-center">
                        Doctor Services
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($services) && $services -> count() > 0)
                                @foreach($services as $service)
                                    <tr>
                                        <th scope="row">{{$service -> id}}</th>
                                        <td>{{$service -> name}}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <form method="POST" action="{{route('save.doctor.services')}}">
                            @csrf
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for=".form-select-sm example">Doctors</label>
                                    <select name="doctor_id" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example">
                                        @foreach($docts as $doc)
                                            <option value="{{$doc->id}}">{{$doc->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="example2">Services</label>
                                    <select name="service_id[]" multiple class="form-select form-select-sm"
                                            aria-label="example2">
                                        @foreach($sers as $ser)
                                            <option value="{{$ser->id}}">{{$ser->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
