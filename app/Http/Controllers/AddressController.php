<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Traits\ResponseApi;
use Exception;

class AddressController extends Controller
{
    use ResponseApi;

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
        return $this->success('Ok', $addresses, 200);
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
     * @param  \App\Http\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        try{
            $newAddress = $this->repository->store($request->all());
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('Address stored', $newAddress, 201);
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
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $address, 200);
    }

    /**
     * Display the specified resource
     *
     * @param  \App\Http\Requests\AddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByCountry(AddressRequest $request)
    {
        try{
            $countryParam = strtolower($request->input('country'));
            $addresses = $this->repository->showByCountry($countryParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $addresses, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\AddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByProvince(AddressRequest $request)
    {
        try{
            $provinceParam = strtolower($request->input('province'));
            $addresses = $this->repository->showByProvince($provinceParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $addresses, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\AddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByLocality(AddressRequest $request)
    {
        try{
            $localityParam = $request->input('locality');
            $addresses = $this->repository->showByLocality($localityParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $addresses, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\AddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByCustomer(AddressRequest $request)
    {
        try{
            $address = $this->repository->showByCustomer($request->input('customer'));
        }catch(Exception $ex) {
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $address, 200);
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
    public function update(UpdateAddressRequest $request, int $id)
    {
        try{
            $addressUpdated = $request->all();
            $addressUpdated = $this->repository->update($id, $addressUpdated);
        }catch(Exception $ex) {
            return $this->error($ex->getMessage());
        }
        return $this->success('Address updated', $addressUpdated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            $this->repository->delete($id);
        }catch(Exception $ex) {
            return $this->error($ex->getMessage());
        }
        return $this->success(self::ADDRESS_DELETED_MESSAGE, [], 200);
    }
}