<?php

namespace App\Interfaces;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

interface AddressRepositoryInterface extends BaseRepositoryInterface
{
    public function getShortAddress(Address $address): string;
    public function getShortLocation(Address $address): string;
    public function getFullAddress(Address $address): string;
    public function showByCountry(string $country): Collection;
    public function showByProvince(string $province): Collection;
    public function showByLocality(string $locality): Collection;
    public function showByCustomer(int $customerId): Address;
}