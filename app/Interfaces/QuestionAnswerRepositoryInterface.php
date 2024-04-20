<?php
namespace App\Interfaces;

use App\Interfaces\BaseInterface;

interface QuestionAnswerRepositoryInterface extends BaseInterface{


    public function getAll($request);
        public function store($data);
        public function getById($id);
        public function update($data, $id);
        public function delete($id);
}
