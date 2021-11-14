<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\AddressRequest;
use App\Interfaces\AddressRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    const ADDRESS_NOT_FOUND_MESSAGE = 'Address not found';
    const ADDRESS_DELETED_MESSAGE = 'Address deletes';
    const INTERNAL_SERVER_ERROR_MESSAGE = 'Internal server error';

    protected AddressRepositoryInterface $repository;

    public function __construct(AddressRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = $this->repository->index();
        return response($addresses, 200);
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
    public function store(AddressRequest $request)
    {
        $newAddress = new Address($request->all());
        $newAddress = $this->repository->store($newAddress);
        if(!$newAddress)
        {
            return response(self::INTERNAL_SERVER_ERROR_MESSAGE, 500);
        }
        return response($newAddress, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try{
            $address = $this->repository->show($id);
        }catch(Exception $ex){
            return response(self::ADDRESS_NOT_FOUND_MESSAGE, 400);
        }
        return response($address, 200);
    }

    public function showByCountry(AddressRequest $request)
    {
        $addresses = $this->repository->showByCountry($request->input('country'));
        echo($request->input('country'));
        if(!$addresses)
        {
            return response(self::ADDRESS_NOT_FOUND_MESSAGE, 400);
        }
        return response($addresses, 200);
    }

    public function showByProvince(AddressRequest $request)
    {
        $addresses = $this->repository->showByProvince($request->input('province'));
        if(!$addresses)
        {
            return response(self::ADDRESS_NOT_FOUND_MESSAGE, 400);
        }
        return response($addresses, 200);
    }

    public function showByLocality(AddressRequest $request)
    {
        $addresses = $this->repository->showByLocality($request->input('locality'));
        if(!$addresses)
        {
            return response(self::ADDRESS_NOT_FOUND_MESSAGE, 400);
        }
        return response($addresses, 200);
    }

    public function showByCustomer(AddressRequest $request)
    {
        $address = $this->repository->showByCustomer($request->input('customer'));
        if(!$address)
        {
            return response(self::ADDRESS_NOT_FOUND_MESSAGE, 400);
        }
        return response($address, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, int $id)
    {
        $addressUpdated = new Address($request->all());
        $addressUpdated = $this->repository->update($id, $addressUpdated);
        if(!$addressUpdated)
        {
            return response(self::INTERNAL_SERVER_ERROR_MESSAGE, 500);
        }
        return response($addressUpdated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addressDeleted = $this->repository->delete($id);
        if($addressDeleted)
        {
            return response(self::INTERNAL_SERVER_ERROR_MESSAGE, 500);
        }
        return response(self::ADDRESS_DELETED_MESSAGE, 200);
    }
}
