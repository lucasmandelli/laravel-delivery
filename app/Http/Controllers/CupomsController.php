<?php

namespace LaravelDelivery\Http\Controllers;

use LaravelDelivery\Http\Requests;
use LaravelDelivery\Http\Requests\AdminCategoryRequest;
use LaravelDelivery\Http\Requests\AdminCupomRequest;
use LaravelDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{


    /**
     * @var CupomRepository
     */
    private $cupomRepository;

    public function __construct(CupomRepository $cupomRepository)
    {

        $this->cupomRepository = $cupomRepository;
    }

    public function index()
    {

        $cupoms = $this->cupomRepository->paginate();

        return view('admin.cupoms.index', compact('cupoms'));
    }
    
    public function create()
    {
        return view('admin.cupoms.create');
    }
    
    public function store(AdminCupomRequest $request)
    {
        $data = $request->all();
        $this->cupomRepository->create($data);
        
        return redirect()->route('admin.cupoms.index');
    }

    public function edit($id)
    {
        $cupom = $this->cupomRepository->find($id);

        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        $data = $request->all();
        $this->cupomRepository->update($data, $id);

        return redirect()->route('admin.cupoms.index');
    }

    public function destroy($id)
    {
        $this->cupomRepository->delete($id);

        return redirect()->route('admin.cupoms.index');
    }
}
