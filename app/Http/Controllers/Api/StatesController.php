<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StateModel;
use App\Transformers\Citiestransformer;
use App\Transformers\StatesTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class StatesController extends Controller {

    /** @var StateModel $model */
    protected $model;
    /**
     * @var Response $response
     */
    private $response;

    public function __construct(Response $response) {

        $this->model = new StateModel();
        $this->response = $response;
    }

    public function getStates(Request $request){

        return $this->response->withCollection($this->model->getStates(), new StatesTransformer(),'states');

    }

}