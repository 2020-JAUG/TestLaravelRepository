<?php

namespace App\Http\Controllers;

abstract class BaseController extends Controller
{
    /** @var string $repository */
    protected string $repository;

    /** @var string $storeRequest */
    protected string $storeRequest;

    /** @var string $updateRequest */
    protected string $updateRequest;

    /** @var string $deleteRequest */
    protected string $deleteRequest;
}