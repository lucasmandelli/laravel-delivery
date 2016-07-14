<?php

namespace LaravelDelivery\Http\Controllers;


use Illuminate\Http\Request;
use LaravelDelivery\Repositories\OrderRepository;
use LaravelDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public $list_status = [ 0 => 'Pendente', 1 => 'Em entrega', 2 => 'Entregue', 3 => 'Cancelado' ];

    public function __construct(OrderRepository $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->paginate();
        $list_status = $this->list_status;
        return view('admin.orders.index', compact('orders', 'list_status'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $order = $this->orderRepository->find($id);
        $list_status = $this->list_status;
        $deliveryman = $userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->orderRepository->update($data, $id);

        return redirect()->route('admin.orders.index');
    }

}