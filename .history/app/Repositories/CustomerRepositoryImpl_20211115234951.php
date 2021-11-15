<?php

namespace App\Repositories;

use App\Exceptions\Customer\CustomerNotFoundException;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CustomerRepositoryImpl extends BaseRepository implements CustomerRepositoryInterface
{
    /** @var string $model */
    protected string $model = Customer::class;

    /** @var array $with */
    protected array $with = [ 'user' ];

    /** @var string $notFoundException */
    protected string $notFoundException = CustomerNotFoundException::class;

    const CUSTOMER_NOT_FOUND_MESSAGE = 'Customer not found';

    /**
     * Get Customer by name attribute
     *
     * @param string $name
     *
     * @method GET
     * @access public
     *
     * @return App\Http\Models\Customer
     * @throws CustomerNotFoundException
     */
    public function showByName(string $name): Customer
    {
        $customer = null;
        try{
            $customer = Customer::with('user')->where('first_name', $name)->firstOrFail();
        } catch(Exception $ex){
            throw new CustomerNotFoundException(self::CUSTOMER_NOT_FOUND_MESSAGE);
        }
        return $customer;
    }

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
    public function showByUser(int $id): Collection
    {
        $customers = null;
        try{
            $customers = Customer::with('user')->where('user_id', $id)->get();
        }catch(Exception $ex){
            throw new CustomerNotFoundException(self::CUSTOMER_NOT_FOUND_MESSAGE);
        }
        return $customers;
    }
}