<?php

namespace LaravelDelivery\Http\Controllers\Api\Client;



use Illuminate\Http\Request;
use LaravelDelivery\Http\Controllers\Controller;
use LaravelDelivery\Repositories\OrderRepository;
use LaravelDelivery\Repositories\ProductRepository;
use LaravelDelivery\Repositories\UserRepository;
use LaravelDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository, OrderService $orderService)
    {

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $user_id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($user_id)->client->id;
        $orders = $this->orderRepository->with('items.product')->scopeQuery(function($query) use($clientId) {
            return $query->where('client_id', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user_id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($user_id)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);
        $order->load('items.product');

        return $order;
    }

    public function show($id)
    {
        $order = $this->orderRepository->with(['client', 'items.product', 'cupom'])->find($id);

        return $order;
    }

}
