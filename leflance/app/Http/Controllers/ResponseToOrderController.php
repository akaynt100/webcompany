<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateResponseToOrder;
use App\Repositories\ResponseToOrderRepository;

use App\Models\Order\Order as OrderModel;

class ResponseToOrderController extends Controller
{
    private $responseRepo;
    private $orderInstance;

    public function __construct(ResponseToOrderRepository $responseRepo, OrderModel $orderModel)
    {
        parent::__construct();
        $this->responseRepo = $responseRepo;
        $this->orderInstance = $orderModel;
    }

    public function responses($userId)
    {
        $responses = $this->user->responses;

        return view('user.response.responses')->with('responses', $responses);
    }

    public function create($userId, $orderId)
    {
        $this->user->can('response-to-order.create', $orderId);

        $order = $this->orderInstance->findOrFail($orderId);

        return view('user.response.create')->with('order', $order);
    }

    public function doCreate($userId, $orderId, CreateResponseToOrder $request)
    {
        $this->responseRepo->create($request->all(), $orderId);
        return back()->with('message.success', trans('notification.response.create'));
    }

    public function doDelete($userId, $responseId)
    {
        $this->responseRepo->delete($responseId);
        return back()->with('message.success', trans('notification.response.delete'));
    }
}
