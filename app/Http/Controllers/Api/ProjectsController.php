<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectModel;
use App\Transformers\ProjectsTransformer;
use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;

class ProjectsController extends Controller
{
    /**
     * @var ProjectModel $model
     */
    private $model;

    /**
     * @var Response $response
     */
    private $response;

    /**
     * Project Api constructor.
     * @param Response $response
     */
    public function __construct(Response $response) {

        $this->response = $response;
        $this->model = new ProjectModel();

    }

    /**
     * Salida para endpoint Project
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getProjects(Request $request) {

        return $this->response->withCollection($this->model->getProjects(), new ProjectsTransformer(),'projects');

    }

    public function setProject(Request $request){

        if(!$request->has(array('id', 'name', 'tax_number'))){

            return $this->response->withError('Datos obligatorios no enviados', 403);

        }

        if(!$request->get('id', null) == 0 ||
            $request->get('name', '') == '' ||
            $request->get('tax_number', null) == '' ){

            return $this->response->withError('Datos obligatorios enviados con formato incorrecto', 404);

        }

        $store = $this->model->getInstance();
        $store->setAttribute('name', $request->get('name', ''));
        $store->setAttribute('tax_number', $request->get('tax_number', ''));
        $store->setAttribute('contact_name', $request->get('contact_name', ''));
        $store->setAttribute('address', $request->get('address', ''));
        $store->setAttribute('cp', $request->get('cp', ''));
        $store->setAttribute('latitude', $request->get('latitude', ''));
        $store->setAttribute('longitude', $request->get('longitude', ''));
        $store->setAttribute('latitude', $request->get('latitude', ''));
        $store->setAttribute('phone_number', $request->get('phone', ''));
        $store->setAttribute('mobil_number', $request->get('mobil', ''));
        $store->setAttribute('fax_number', $request->get('fax', ''));
        $store->setAttribute('email', $request->get('email', ''));
        $store->setAttribute('description', $request->get('description', ''));

        if($request->get('city', array('id'=>0))['id'] !== 0){
            $store->setAttribute('city_id', $request->get('city')['id']);
        }

        if($store->save()){
            return \response()->json(array('status'=>'ok','id' => $store->getAttribute('id')));
        } else {
            return $this->response->withError('No Guardado correctamente: Error en guardado SQl', '201');
        }

    }

    public function updateProject(Request $request, $id){

        if(!$request->has(array('id', 'name', 'tax_number')) && ! is_int($id) ){

            return $this->response->withError('Datos obligatorios no enviados', 403);

        }

        if($request->get('id', null) == 0 ||
            $id == 0 ||
            $request->get('name', '') == '' ||
            $request->get('tax_number', null) == '' ){

            return $this->response->withError('Datos obligatorios enviados con formato incorrecto', 404);

        }

        $store = $this->model->getProjectById($id);
        $store->setAttribute('name', $request->get('name', ''));
        $store->setAttribute('tax_number', $request->get('tax_number', ''));
        $store->setAttribute('contact_name', $request->get('contact_name', ''));
        $store->setAttribute('address', $request->get('address', ''));
        $store->setAttribute('cp', $request->get('cp', ''));
        $store->setAttribute('latitude', $request->get('latitude', ''));
        $store->setAttribute('longitude', $request->get('longitude', ''));
        $store->setAttribute('latitude', $request->get('latitude', ''));
        $store->setAttribute('phone_number', $request->get('phone', ''));
        $store->setAttribute('mobil_number', $request->get('mobil', ''));
        $store->setAttribute('fax_number', $request->get('fax', ''));
        $store->setAttribute('email', $request->get('email', ''));
        $store->setAttribute('description', $request->get('description', ''));

        if($request->get('city', array('id'=>0))['id'] !== 0){
            $store->setAttribute('city_id', $request->get('city')['id']);
        }

        if($store->save()){
            return \response()->json(array('status'=>'ok','id' => $store->getAttribute('id')));
        } else {
            return $this->response->withError('No Guardado correctamente: Error en guardado SQl', '201');
        }

    }



}
