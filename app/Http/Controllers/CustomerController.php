<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select('id', 'fullname', 'gender', 'address', 'email', 'phone')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button onclick="removedata(' . $row->id . ')" type="button" class="btn btn-sm btn-danger" title="Remove Data">
                    <i class="fas fa-trash-alt"></i>
                    </button>&nbsp<button onclick="editdata(' . $row->id . ')" type="button" class="btn btn-sm btn-info" title="Edit Data">
                    <i class="fas fa-edit" style="color:white; "></i>
                    </button>';
                })
                ->make(true);
        }

        // return view('users');
        // $data = Customer::all();
        // return view('customer.data')->with(['data' => $data]);
        return view('customer.data');
    }

    public function form(Request $request)
    {
        if ($request->ajax()) {
            $st = $request->query('st');
            if ($st == 'new') {
                return view('customer.modal')->fragment('modal-add');
            }
            if ($st == 'edit') {
                return view('customer.modal')->fragment('modal-edit');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $validate = $request->validated();

        if ($request->hasFile('photo')) {
            $path = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('images'), $path);
        } else {
            $path = '';
        }

        $customer = new Customer();
        $customer->fullname = $request->fullname;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->photo = $path;
        $customer->save();

        echo json_encode([
            'success' => 'data saved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        if (File::exists(public_path('images/'.$data->photo))) {
            File::delete(public_path('images/' . $data->photo));
        }
        $data->delete();

        echo json_encode([
            'success' => 'Data deleted successfully'
        ]);
    }
}
