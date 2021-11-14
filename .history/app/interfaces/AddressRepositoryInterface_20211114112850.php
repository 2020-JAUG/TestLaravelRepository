<?php

namespace App\Interfaces;

use Address;
use Illuminate\Database\Eloquent\Collection;

interface AddressRepositoryInterface extends BaseRepositoryInterface
{
    public function getShortAddress(): string;
    public function getShortLocation(): string;
    public function getFullAddress(): string;
    public function showByCountry(string $country): Collection;
    public function showByProvince(string $province): Collection;
    public function showByLocality(string $locality): Collection;
    public function showByCustomer(int $customerId): Address;
}
