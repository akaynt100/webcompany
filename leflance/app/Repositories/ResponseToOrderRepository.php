<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 30.01.2017
 * Time: 13:29
 */

namespace App\Repositories;

use App\Models\City;
use App\Models\ResponseToOrder;
use App\Repositories\Contracts\IResponseToOrderRepository;


class ResponseToOrderRepository implements IResponseToOrderRepository
{
    protected $instance;

    /**
     * OrderRepository constructor.
     * @param ResponseToOrder $instance
     */
    public function __construct(ResponseToOrder $instance)
    {
        $this->instance = $instance;
    }

    public function create(array $data, int $orderId)
    {
        \Auth::user()->can('response-to-order.create', $orderId);

        $instance = $this->getInstance();
        $result = $instance->create(
            [
                'order_id' => $orderId,
                'user_id' => \Auth::user()->id,
                'city_id' => $cityId = City::findBy('name', $data['city']),
                'status_id' => $instance->getStatusWaiting()->get('id'),
                'city_other' => is_null($cityId) ? $data['city'] : null,
                'deadline' => \DateTimeHelper::parseDate($data['deadline'], 'Y-m-d'),
                'comment' => $data['comment']
            ]
        );
        return $result;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function delete($responseId)
    {
        \Auth::user()->can('response-to-order.delete', $responseId);

        return $this->getInstance()->find($responseId)->delete();
    }

    public function find($responseId)
    {
        return $this->getInstance()->findOrFail($responseId);
    }
}