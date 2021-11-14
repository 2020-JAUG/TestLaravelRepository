<?php

namespace App\Interfaces;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get Customer by Name
     *
     * @param string $name
     *
     * @method GET
     * @access public
     *
     * @return App\Models\Customer
     * @throws CustomerNotFoundException
     */
    public function showByName(string $name):Customer;

    /**
     * Get Customer by User id
     *
     * @param int $id
     *
     * @method GET
     * @access public
     *
     * @return Collection<Customer>
     * @throws CustomerNotFoundException
     */
    public function showByUser(int $id):Collection;
}
