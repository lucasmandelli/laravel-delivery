<?php

namespace LaravelDelivery\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDelivery\Repositories\OrderRepository;
use LaravelDelivery\Repositories\ProductRepository;
use LaravelDelivery\Repositories\UserRepository;
use LaravelDelivery\Services\OrderService;

class CheckoutController extends Controller
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
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->orderRepository->scopeQuery(function($query) use($clientId) {
            return $query->where('client_id', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->all();

        return view('customer.order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->orderService->create($data);

        return redirect()->route('customer.orders.index');
    }

}
