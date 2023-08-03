<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Repositories\CustomersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomersController extends Controller
{
    private CustomersRepository $customersRepository;

    protected $sortFields = ['customer', 'name', 'start_date', 'end_date', 'created_at', 'updated_at'];

    public function __construct(CustomersRepository $customersRepository)
    {
        $this->middleware('auth:api');
        $this->customersRepository = $customersRepository;
    }

    public function all(Request $request): JsonResponse
    {
        $customers = $this->customersRepository->getAllCustomers();
        return $this->success(CustomerResource::collection($customers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $input = $this->input(['name', 'reg_number', 'phone']);
        $validator = $this->validateInput($input, [], new Customer());

        if ($validator) {
            return $this->error($validator);
        }

        $customer = $this->customersRepository->createCustomer($input);
        return $this->success(new CustomerResource($customer));
    }

    /**
     * Display the specified resource.
     */
    public function get(Request $request, int $id)
    {
        $customer = $this->customersRepository->getCustomerById($id);

        if ($customer) {
            return $this->success(new CustomerResource($customer));
        }

        return $this->error('Not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $customer = $this->customersRepository->getCustomerById($id);

        if (!$customer) {
            return $this->error('Not found', 404);
        }

        $input = $this->input(['name', 'reg_number', 'phone']);
        $validator = $this->validateInput($input, [], new Customer());

        if ($validator) {
            return $this->error($validator);
        }



        $updated_customer = $this->customersRepository->updateCustomer($customer, $input);
        return $this->success(new CustomerResource($updated_customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, int $id)
    {
        $customer = $this->customersRepository->getCustomerById($id);

        if (!$customer) {
            return $this->error('Not found', 404);
        }

        $delete_customer = $this->customersRepository->deleteCustomer($customer);

        if ($delete_customer) {
            return $this->success();
        }

        return $this->error('Something went wrong');
    }
}
