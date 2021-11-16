<?php

namespace App\Repositories;

use App\Exceptions\Address\AddressNotFoundException;
use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

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

    /** @var string $notFoundException */
    protected string $notFoundException = AddressNotFoundException::class;

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
            throw new $this->notFoundException($this->notFoundMessage);
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
            throw new $this->notFoundException($this->notFoundMessage);
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
            throw new $this->notFoundException($this->notFoundMessage);
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
            throw new $this->notFoundException($this->notFoundMessage);
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
}