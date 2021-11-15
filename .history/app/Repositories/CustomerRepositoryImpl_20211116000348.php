<?php

namespace App\Repositories;

use App\Exceptions\Customer\CustomerNotFoundException;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;

final class CustomerRepositoryImpl extends BaseRepository implements CustomerRepositoryInterface
{
    /** @var string $model */
    protected string $model = Customer::class;

    /** @var array $with */
    protected array $with = [ 'user' ];

    /** @var string $notFoundException */
    protected string $notFoundException = CustomerNotFoundException::class;

    protected string $notFoundMessage = 'Customer not found';

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
            throw new $this->notFoundException($this->notFoundMessage);
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
            throw new $this->notFoundException($this->notFoundMessage);
        }
        return $customers;
    }
}