<?php

namespace App\Interfaces;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

interface AddressRepositoryInterface extends BaseRepositoryInterface
{
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
    public function getShortAddress(Address $address): string;

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
    public function getShortLocation(Address $address): string;

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
    public function getFullAddress(Address $address): string;

    /**
     * Get Addresses collection by country
     *
     * @param string $country
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     */
    public function showByCountry(string $country): Collection;

    /**
     * Get Addresses collection by province
     *
     * @param string $province
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     */
    public function showByProvince(string $province): Collection;

    /**
     * Get Address collection by locality
     *
     * @param string $locality
     *
     * @method GET
     * @access public
     *
     * @return Collection<Address>
     */
    public function showByLocality(string $locality): Collection;

    /**
     * Get Address by Customer id
     *
     * @param int $customerId
     *
     * @method GET
     * @access public
     *
     * @return \App\Models\Address
     */
    public function showByCustomer(int $customerId): Address;
}
