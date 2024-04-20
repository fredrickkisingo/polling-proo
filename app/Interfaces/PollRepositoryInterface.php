<?php
namespace App\Interfaces;

use App\Interfaces\BaseInterface;

interface PollRepositoryInterface extends BaseInterface{

    public function getPolls($request);

}
