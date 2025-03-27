<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        //get data customers
        $customers = DB::table('customers')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('pages.customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \App\Models\Customer::create($data);
        return redirect()->route('customer.index')->with('success', 'Customer successfully created');
    }

    public function edit($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        return view('pages.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->all();
        $customer->update($data);
        return redirect()->route('customer.index')->with('success', 'Customer successfully updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer successfully deleted');
    }
}
