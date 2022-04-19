<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{

    public function test_valid_phone_number()
    {

        Customer::factory()->create();

        $customer = Customer::orderBy('id', 'desc')->first();

        $this->assertEquals($customer->getPhoneNumber()->getState(), 'OK');
        $this->assertEquals($customer->getPhoneNumber()->getCountry(), 'Mozambique');
        $this->assertEquals($customer->getPhoneNumber()->getCountryCode(), '+258');

        Customer::destroy($customer->id);
    }

    
    public function test_invalid_phone_number()
    {

        Customer::factory()->create([
            'phone' => '(258) 8AF563885',
        ]);

        $customer = Customer::orderBy('id', 'desc')->first();

        $this->assertEquals($customer->getPhoneNumber()->getState(), 'NOK');
        $this->assertEquals($customer->getPhoneNumber()->getCountry(), 'Mozambique');
        $this->assertEquals($customer->getPhoneNumber()->getCountryCode(), '+258');

        Customer::destroy($customer->id);
    }
    
}
