<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Transformers\Citiestransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class CitiesController extends Controller {

    /** @var CityModel $model */
    protected $model;
    /**
     * @var Response $response
     */
    private $response;

    public function __construct(Response $response) {

        $this->model = new CityModel();
        $this->response = $response;
    }

    public function getCities(Request $request){

        return $this->response->withCollection($this->model->getCities(), new Citiestransformer(),'cities');

    }

    public function getCitiesByStateId($stateId){

        if(!is_null($stateId)){
            return $this->response->withCollection($this->model->getCitiesByStateId($stateId), new Citiestransformer(),'cities');
        }
        return $this->response->withError('No recibido state_id','501');

    }

}
