<?php

namespace LaravelDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaravelDelivery\Repositories\OrderItemRepository;
use LaravelDelivery\Models\OrderItem;
use LaravelDelivery\Validators\OrderItemValidator;

/**
 * Class OrderItemRepositoryEloquent
 * @package namespace LaravelDelivery\Repositories;
 */
class OrderItemRepositoryEloquent extends BaseRepository implements OrderItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
