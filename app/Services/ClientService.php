<?php

namespace LaravelDelivery\Services;
use LaravelDelivery\Repositories\ClientRepository;
use LaravelDelivery\Repositories\UserRepository;

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 11/07/2016
 * Time: 20:52
 */
class ClientService
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {

        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        if(!isset($data['user']['password'])){
            $data['user']['password'] = bcrypt(123456);
        }
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);
        $userId = $this->clientRepository->find($id, ['user_id'])->user_id;

        $this->userRepository->update($data['user'], $userId);
    }
}