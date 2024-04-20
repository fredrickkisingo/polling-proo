<?php

namespace App\Services;



use App\Interfaces\QuestionAnswerRepositoryInterface;


class QuestionAnswerService
{


    private QuestionAnswerRepositoryInterface $repository;

    public function __construct(
       QuestionAnswerRepositoryInterface $repository
    ) {

        $this->repository = $repository;

    }

    public function getAll(\Illuminate\Http\Request $request)
    {
        return $this->repository->getAll($request);

    }

    /**
     * @param $request
     * @return String
     */
    public function store($request): string
    {
        return $this->repository->store($request);
    }

    public function getById($id){
        return $this->repository->getById($id);
    }

    public function update($data, $id){
        return $this->repository->update($data, $id);
    }
    public function delete($id){
        return $this->repository->delete($id);
    }
}
