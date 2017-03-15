<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder;
use App\Http\Requests\UpdateOrder;

use App\Repositories\OrderRepository;

use App\Models\Order\Order as OrderModel;

class OrderController extends Controller
{
    private $orderRepo;
    private $orderInstance;

    public function __construct(OrderRepository $orderRepository, OrderModel $orderInstance)
    {
        parent::__construct();

        $this->orderRepo = $orderRepository;
        $this->orderInstance = $orderInstance;
    }

    public function orders()
    {
        $orders = $this->orderInstance->allowed();

        return view('user.order.orders')->with('orders', $orders);
    }

    public function custom()
    {
        $orders = $this->orderInstance->custom();
        return view('user.order.orders-custom')->with('orders', $orders);
    }

    public function create()
    {
        $this->user->can('order.create');

        return view('user.order.create');
    }

    public function doCreate(CreateOrder $request)
    {
        $order = $this->orderRepo->create($request->all());

        return redirect(route('order.show', [$this->user->id, $order->id]));
    }

    public function order($userId, $orderId)
    {
        //$this->user->can('order.create');

        $order = ($this->orderInstance)::findOrFail($orderId);

        return view('user.order.detail')->with('order', $order);
    }

    public function update($userId, $orderId)
    {
        \Auth::user()->can('order.update', $orderId);

        $order = ($this->orderInstance)::findOrFail($orderId);

        return view('user.order.update')->with('order', $order);
    }

    public function doUpdate($userId, $orderId, UpdateOrder $request)
    {
        $order = $this->orderRepo->update($orderId, $request->all());

        return redirect(route('order.show', [$this->user->id, $order->id]))
            ->with('message.success', trans('notification.order.update'));
    }

    public function doDelete($userId, $orderId)
    {
        $this->orderRepo->delete($orderId);

        return redirect(route('orders.list', $this->user->id))->with('message.success', trans('notification.order.delete'));
    }

    public function getFile($userId, $orderId, $fileId)
    {
        return $this->orderInstance->getFile($orderId, $fileId);
    }
}
