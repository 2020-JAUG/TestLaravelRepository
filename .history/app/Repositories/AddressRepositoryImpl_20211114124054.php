<?php

namespace App\Repositories;

use App\Models\Address;
use App\Interfaces\AddressRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class AddressRepositoryImpl implements AddressRepositoryInterface
{
    public function index()
    {
        return Address::all();
    }

    public function show(int $id)
    {
        $address = null;
        try{
            $address = Address::findOrFail($id);
        }catch(Exception $ex){

        }
        return $address;
    }

    public function showByCountry(string $country): Collection
    {
        $address = null;
        try{
            $address = Address::where('country', $country)->get();
        }catch(Exception $ex){

        }
        return $address;
    }

    public function showByProvince(string $province): Collection
    {
        $address = null;
        try{
            $address = Address::where('province', $province)->get();
        }catch(Exception $ex){

        }
        return $address;
    }

    public function showByLocality(string $locality): Collection
    {
        $address = null;
        try{
            $address = Address::where('locality', $locality)->get();
        }catch(Exception $ex){

        }
        return $address;
    }

    public function showByCustomer(int $customerId): Address
    {
        $address = null;
        try{
            $address = Address::where('customer_id', $customerId)->get();
        }catch(Exception $ex){

        }
        return $address;
    }

    public function getShortAddress(Address $address): string
    {
        return $address->getShortAddressAttribute();
    }

    public function getShortLocation(Address $address): string
    {
        return $address->getShortLocationAttribute();
    }

    public function getFullAddress(Address $address): string
    {
        return $address->getFullAddressAttribute();
    }

    public function store(Model $address)
    {
        $newAddress = null;
        DB::beginTransaction();
        try{
            $newAddress = $address;
            $newAddress->save();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
        return $newAddress;
    }

    public function update(int $id, Model $address)
    {
        $addressToUpdate = $this->show($id);
        DB::beginTransaction();
        try{
            foreach($address->toArray() as $key => $value)
            {
                if(isset($address[$key]))
                {
                    $addressToUpdate->$key = $address[$key];
                }
            }
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
        }
        return $addressToUpdate;
    }

    public function delete(int $id)
    {
        $addressToDelete = $this->show($id);
        DB::beginTransaction();
        try{
            $addressToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return false;
        }
    }
}
