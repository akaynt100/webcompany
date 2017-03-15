<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 30.01.2017
 * Time: 13:29
 */

namespace App\Repositories\Contracts;


interface IResponseToOrderRepository
{
    function create(array $data, int $orderId);

    function delete($responseId);

    function find($responseId);
}