<?php

namespace App\Interfaces;

interface BaseInterface {

    // common methods to be implemented by all repositories
    public function getAll($request);
    public function getById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);

}
