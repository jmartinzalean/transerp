<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Transformers\ClientsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class ClientsController extends Controller
{
    /**
     * @var ClientModel $elementModel
     */
    private $model;

    /**
     * @var Response $response
     */
    private $response;

    /**
     * Client Api constructor.
     * @param Response $response
     */
    public function __construct(Response $response) {

        $this->response = $response;
        $this->model = new ClientModel();

    }

    /**
     * Salida para endpoint Clients
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getClients(Request $request) {

        return $this->response->withCollection($this->model->getClients(), new ClientsTransformer(),'clients');

    }


}
