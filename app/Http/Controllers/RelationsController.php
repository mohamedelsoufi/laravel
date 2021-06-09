<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class RelationsController extends Controller
{
    public function oneToOne()
    {
//        $user = User::with('phone')->find(4);
//        $user -> phone;
        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(4);
//        return response()->json($user);
        return $user->phone->code;
    }

    public function oneToOneReverse()
    {
        $phone = Phone::with(['user' => function ($q) {
            $q->select('id', 'name', 'email');
        }])->find(1);
        // to make hidden attribute visible in this method
        $phone->makeVisible(['user_id']);
//         $phone -> makeHidden(['code']);
        return $phone;
        //return $phone -> user ; //return user of this number
    }

    public function getUserHasPhone()
    {
//        return User::whereHas('phone')->get();
        return User::with('phone')->whereHas('phone', function ($q) {
            $q->where('code', '02');
        })->get();
    }

    public function getUserNotHasPhone()
    {
        return User::whereDoesntHave('phone')->get();
    }

    ///////// one to many relation

    public function getHospitalDoctors()
    {
//        $hospital = Hospital::find(1);
//        return $hospital -> doctors;
        $hospital = Hospital::with('doctors')->find(1);
//        $doctors = $hospital -> doctors;

//        foreach ($doctors as $doc){
//            echo $doc -> name.'<br>';
//        }

//        $doctor = Doctor::find(3);
//        return $doctor -> hospital ->name;

        $hospital = Hospital::with(['doctors' => function ($q) {
            $q->select('name', 'title', 'hospital_id');
        }])->find(3);
        return response()->json($hospital);
    }

    public function hospitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($id)
    {
        $hospitals = Hospital::find($id);
        $doctors = $hospitals->doctors;
        $doctors->makeHidden(['hospita_id']);
        return view('doctors.doctors', compact('doctors'));
    }

    public function hospitals_has_doctors()
    {
        $hospital = Hospital::whereHas('doctors')->get();
        return response()->json($hospital);
    }

    public function hospitals_has_doctors_male()
    {
//        return $hospital = Hospital::with('doctors')->whereHas('doctors',function($q){
//            $q->where('gender',2);
//        })->get();

        return $hospital = Hospital::with(['doctors' => function ($q) {
            $q->where('gender', 2);
        }])->get();
    }

    public function hospitals_has_not_doctors()
    {
        return $hospitals = Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return redirect()->route('offers.index');
        }
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->back();
    }

    /// many to many relation
    public function getDoctorService()
    {
        return $doctor = Doctor::with('services')->find(2);
//        return $doctor->services;
    }

    public function getServiceDoctors()
    {
        return $service = Service::with('doctors')->find(2);
//        return $doctor->services;
    }

    public function getDoctorServices($id)
    {
        $doctor = Doctor::find($id);
        $services = $doctor->services;

        $docts = Doctor::select('id', 'name')->get();
        $sers = Service::select('id', 'name')->get();
        return view('doctors.services', compact('services', 'docts', 'sers'));
    }

    public function SaveServicesToDoctor(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort('404');
//        $doctor->services()->attach($request->service_id);
//        $doctor->services()->sync($request->service_id);
        $doctor->services()->syncWithoutDetaching($request->service_id);
        return 'success';
    }

    /// has one through
    public function getPatientDoctor()
    {
        $patient = Patient::with('doctors')->find(2);
//        return $patient->doctors;
    }

    // has many through

    public function getCountryDoctors()
    {
//        $country = Country::find(1); //has many through
//        return $country->doctors;


        // country with doctors
//        $country = Country::with(['doctors'],function ($q){
//            $q->select('name','hospital_id');
//        })->find(1);
//        return response()->json($country);

        // country with hospitals
        $country = Country::with(['hospitals'], function ($q) {
            $q->select('name', 'country_id');
        })->find(1);
        return response()->json($country);
    }

    ################# Accessors and Mutators #######################
    public function getDoctors()
    {
        return $doctors = Doctor::select('id', 'name', 'gender')->get();
//      if (isset($doctors) && $doctors->count() > 0){
//            foreach ($doctors as $doctor){
//                $doctor -> gender = $doctor -> gender == 1 ? 'male' : 'female';
//            }
//        }
//        return $doctors;
    }
}
