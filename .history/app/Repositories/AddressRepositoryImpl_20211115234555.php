<?php

namespace App\Repositories;

use App\Exceptions\Address\AddressNotFoundException;
use App\Models\Address;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class AddressRepositoryImpl extends BaseRepository implements AddressRepositoryInterface
{
    /** @var string $model */
    protected string $model = Address::class;

        /** @var array $with */
    protected array $with = [ 'customer' ];

    /** @var array $withCount */
    protected array $withCount = [ 'customer' ];

    /** @var array $append */
    protected array $append = ['customer.user'];

    protected string $notFoundException = AddressNotFoundException::class;

    const ADDRESS_NOT_FOUND_MESSAGE = 'Address not found';

    /**
     * Get Addresses
     *
     * @method GET api/address
     * @access public
     *
     * @return Collection<Address>
     */
    // public function index(): Collection
    // {
    //     return Address::with(['customer'])->get();
    // }

    /**
     * Get Addres by id
     *
     * @param int $id
     *
     * @method GET api/address/{id}
     * @access public
     *
     * @return \App\Models\Address
     * @throws AddressNotFoundException
     */
    // public function show(int $id): Address
    // {
    //     $address = null;
    //     try{
    //         $address = Address::findOrFail($id);
    //     }catch(Exception $ex){
    //         throw new AddressNotFoundException(self::ADDRESS_NOT_FOUND_MESSAGE);
    //     }
    //     return $address;
    // }

    /**
     * Get Address by country
     *
     * @param string $country
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     * @throws AddressNotFoundException
     */
    public function showByCountry(string $country): Collection
    {
        $address = null;
        try{
            $address = Address::where('country', $country)->get();
        }catch(Exception $ex){
            throw new AddressNotFoundException(self::ADDRESS_NOT_FOUND_MESSAGE);
        }
        return $address;
    }

    /**
     * Get Addres by province
     *
     * @param string $province
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     * @throws AddressNotFoundException
     */
    public function showByProvince(string $province): Collection
    {
        $address = null;
        try{
            $address = Address::where('province', $province)->get();
        }catch(Exception $ex){
            throw new AddressNotFoundException(self::ADDRESS_NOT_FOUND_MESSAGE);
        }
        return $address;
    }

    /**
     * Get Address by locality
     *
     * @param string $locality
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     * @throws AddressNotFoundException
     */
    public function showByLocality(string $locality): Collection
    {
        $address = null;
        try{
            $address = Address::where('locality', $locality)->get();
        }catch(Exception $ex){
            throw new AddressNotFoundException(self::ADDRESS_NOT_FOUND_MESSAGE);
        }
        return $address;
    }

    /**
     * Get Address by Customer id
     *
     * @param int @id
     *
     * @method GET
     * @access public
     *
     * @return \App\Models\Address
     * @throws AddresNotFoundException
     */
    public function showByCustomer(int $customerId): Address
    {
        $address = null;
        try{
            $address = Address::where('customer_id', $customerId)->firstOrFail();
        }catch(Exception $ex){
            throw new AddressNotFoundException(self::ADDRESS_NOT_FOUND_MESSAGE);
        }
        return $address;
    }

    /**
     * Get short address attribute
     *
     * @param \App\Models\Address $address
     *
     * @method GET
     * @access public
     *
     * @return string
     */
    public function getShortAddress(Address $address): string
    {
        return $address->getShortAddressAttribute();
    }

    /**
     * Get short location attribute
     *
     * @param \App\Models\Address $address
     *
     * @method GET
     * @access public
     *
     * @return string
     */
    public function getShortLocation(Address $address): string
    {
        return $address->getShortLocationAttribute();
    }

    /**
     * Get full address attribute
     *
     * @param \App\Models\Address $address
     *
     * @method GET
     * @access public
     *
     * @return string
     */
    public function getFullAddress(Address $address): string
    {
        return $address->getFullAddressAttribute();
    }

    /**
     * Save a new Address
     *
     * @param \App\Models\Address $address
     *
     * @method POST api/address
     * @access public
     *
     * @return \App\Models\Address
     * @throws Exception
     */
    // public function store(Model $address): Address
    // {
    //     $newAddress = null;
    //     DB::beginTransaction();
    //     try{
    //         $newAddress = $address;
    //         $newAddress->country = strtolower($newAddress->country);
    //         $newAddress->province = strtolower($newAddress->province);
    //         $newAddress->locality = strtolower($newAddress->locality);
    //         $newAddress->save();
    //         DB::commit();
    //     }catch(Exception $ex){
    //         DB::rollBack();
    //         throw $ex;
    //     }
    //     return $newAddress;
    // }

    /**
     * Update an Address
     *
     * @param int $id
     * @param \App\Models\Address $address
     *
     * @method PUT api/address/{id}
     * @access public
     *
     * @return \App\Models\Address
     * @throws Exception
     */
    // public function update(int $id, Model $address): Address
    // {
    //     $addressToUpdate = $this->show($id);
    //     DB::beginTransaction();
    //     try{
    //         foreach($address->toArray() as $key => $value)
    //         {
    //             if(isset($address[$key]))
    //             {
    //                 $addressToUpdate->$key = $address[$key];
    //             }
    //         }
    //         DB::commit();
    //     }catch(Exception $ex){
    //         DB::rollBack();
    //         throw $ex;
    //     }
    //     return $addressToUpdate;
    // }

    /**
     * Delete an address
     *
     * @param int $id
     *
     * @method DELETE api/<model>/{id}
     * @access public
     *
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $addressToDelete = $this->show($id);
        DB::beginTransaction();
        try{
            $addressToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
    }
}