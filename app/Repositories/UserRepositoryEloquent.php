<?php

namespace LaravelDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaravelDelivery\Repositories\UserRepository;
use LaravelDelivery\Models\User;
use LaravelDelivery\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace LaravelDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getDeliverymen()
    {
        return $this->model->where(['role' => 'deliveryman'])->lists('name', 'id');
    }
}
