<?php
namespace App\Repositories;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomersRepository {

    public function getAllCustomers ()
    {
        return Customer::all();
    }

    public function createCustomer (array $data)
    {
        return Customer::create($data);
    }

    public function getCustomerById(int $id)
    {
        return Customer::find($id);
    }

    public function updateCustomer(Customer $customer, array $data)
    {
        $update = $customer->update($data);
        return $customer->refresh();
    }

    public function deleteCustomer(Customer $customer)
    {
        return $customer->delete();
    }
}
