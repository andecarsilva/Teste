<?php

namespace App\Http\Controllers;

use App\Helpers\Tools;
use App\Models\Customer;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'cpf' => 'required|unique:customers',
        ]);

        $name = $request->name;
        $birth_date = $request->birth_date;
        $rg = $request->rg;
        $cpf = $request->cpf;
        $zip_code = $request->zip_code;
        $address = $request->address;
        $number = $request->number;
        $district = $request->district;
        $public_place = $request->public_place;
        $county = $request->county;
        $profile_picture = $request->profile_picture;

        if($request->file('profile_picture')){
            $file= $request->file('profile_picture');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('assets/users'), $filename);
            $profile_picture= $filename;
        }

        $customer = Customer::create([
            'name' => $name,
            'birth_date' => $birth_date,
            'rg' => $rg,
            'cpf' => $cpf,
            'zip_code' => $zip_code,
            'address' => $address,
            'number' => $number,
            'district' => $district,
            'public_place' => $public_place,
            'county' => $county,
            'profile_picture' => $profile_picture,
            'status_cliente' => false
        ]);

        return back()->withStatus('Cliente Cadastrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }


    public Function editView($id)
    {
        $customer = Customer::find($id);

        return view('Customer.edit_customer', compact('customer'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer = Customer::find($request->id);
        $customer->name            = (isset($request->name) && !Tools::IsNullOrEmpty($request->name)) ? $request->name : $customer->name;
        $customer->birth_date      = (isset($request->birth_date) && !Tools::IsNullOrEmpty($request->birth_date)) ? $request->birth_date : $customer->birth_date;
        $customer->rg              = (isset($request->rg) && !Tools::IsNullOrEmpty($request->rg)) ? $request->rg : $customer->rg;
        $customer->zip_code        = (isset($request->zip_code) && !Tools::IsNullOrEmpty($request->zip_code)) ? $request->zip_code : $customer->zip_code;
        $customer->address         = (isset($request->address) && !Tools::IsNullOrEmpty($request->address)) ? $request->address : $customer->address;
        $customer->public_place    = (isset($request->public_place) && !Tools::IsNullOrEmpty($request->public_place)) ? $request->public_place : $customer->public_place;
        $customer->number          = (isset($request->number) && !Tools::IsNullOrEmpty($request->number)) ? $request->number : $customer->number;
        $customer->district        = (isset($request->district) && !Tools::IsNullOrEmpty($request->district)) ? $request->district : $customer->district;
        $customer->county          = (isset($request->county) && !Tools::IsNullOrEmpty($request->county)) ? $request->county : $customer->county;

       $customer->save();

        return redirect('home')->withStatus('Cliente Alterado!');
    }

    public function searchSustomer(Request $request)
    {

        $query = Customer::query();

        if($request->has('name_search'))
        {
            $query->where('name','LIKE',"%$request->name_search%");
        }

        if($request->has('cpf_search'))
        {
            $query->where('cpf','LIKE',"%$request->cpf_search%");
        }

        $customers = $query->get();

        return view('dashboard',compact('customers'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        return "";
    }
}
