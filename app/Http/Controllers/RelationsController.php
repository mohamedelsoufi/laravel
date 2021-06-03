<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

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
}
