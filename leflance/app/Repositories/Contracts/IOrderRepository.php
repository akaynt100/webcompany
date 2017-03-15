<?php

namespace App\Repositories\Contracts;

interface IOrderRepository
{
    function create(array $data);

    function update($orderId, array $data);

    function delete($orderId);


}