<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use Illuminate\Http\Request;

class CitiesController extends Controller {

    /** @var CityModel $model */
    protected $model;

    public function __construct() {

        $this->model = new CityModel();
    }

    public function getCities(Request $request){

        dd($this->model->getClients()->get());

    }

}
