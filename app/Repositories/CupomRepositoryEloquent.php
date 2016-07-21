<?php

namespace LaravelDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaravelDelivery\Repositories\CupomRepository;
use LaravelDelivery\Models\Cupom;
use LaravelDelivery\Validators\CupomValidator;

/**
 * Class CupomRepositoryEloquent
 * @package namespace LaravelDelivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
