<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(15);
        $country = '0';
        $state = '0';
        return view('home', 
        [
            'customers' => $customers,
            'country' => $country,
            'state' => $state
        ]);
    }

    public function filter(Request $request)
    {

        $country = $request->input('country');
        $state = $request->input('state');

        $customers = Customer::when($country, function ($query, $country) {
            $query->where('phone', 'like', $country . '%');
        })
        ->get();

        if($state != '0'){
            $customers = $this->phoneNumberValidation($state, $customers);
        }
        
        $customers = $customers->paginate(15);

        return view('home', [
            'customers' => $customers,
            'country' => $country,
            'state' => $state
        ]);
    }

    protected function phoneNumberValidation($state, $customers){

        if($state == 'OK'){

            $filtered = $customers->filter(function ($value) {
                return $value->getPhoneNumber()->getState() == 'OK';
            });

            $sorted = $filtered->sortBy('id');

            $customers = $sorted; 
        }else{

            $filtered = $customers->filter(function ($value) {
                return $value->getPhoneNumber()->getState() == 'NOK';
            });

            $sorted = $filtered->sortBy('id');

            $customers = $sorted;

        }

        return $customers;

    }
}
