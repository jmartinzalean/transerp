<?php

namespace App\Entities;


use App\Models\ClientModel;
use App\Models\ProjectModel;
use App\Models\ProjectServiceModel;
use Illuminate\Database\Eloquent\Collection;

class Project {

    /** @var ProjectModel $model */
    private $model;

    /** @var null|ProjectServiceModel[]|Collection $services  */
    private $services = null;

    /** @var null|Client $client  */
    private $client = null;



    /**
     * Project constructor.
     * @param ProjectModel $projectModel
     */
    public function __construct(ProjectModel $projectModel) {

        $this->model = $projectModel;

    }

    /**
     * @return mixed
     */
    public function getName(){

        return $this->model->getAttribute('name');

    }

    /**
     * @return mixed
     */
    public function getDateStart(){

        return $this->model->getAttribute('date_start');

    }

    /**
     * @return mixed
     */
    public function getDateEnd(){

        return $this->model->getAttribute('date_end');

    }

    /**
     * @return mixed
     */
    public function getStatus(){

        return $this->model->getAttribute('status');

    }

    /**
     * @return mixed
     */
    public function getDescription(){

        return $this->model->getAttribute('description');

    }

    /**
     * @return bool
     */
    public function isActive(){

        return ($this->getStatus() == 1);

    }

    /**
     * @return mixed
     */
    public function getClientId(){

        return $this->model->getAttribute('client_id');

    }

    /**
     * @return mixed
     */
    public function getId(){

        return $this->model->getAttribute('id');

    }

    /**
     * @return Client|false|null
     */
    public function getClient(){
        if(is_null($this->client)){
            $this->setClient();
        }
        return $this->client;
    }

    /**
     * @return bool
     */
    public function hasClient(){

        return (!!is_null($this->client) && $this->client instanceof Client);
    }


    public function getServices(){

        if(is_null($this->services)){
            $this->setServices();
        }
        return $this->services;

    }

    public function hasServices(){

        if(is_null($this->services)){
            $this->setServices();
        }
        return ($this->services->count() > 0);

    }

    public function countServices(){

        if(is_null($this->services)){
            $this->setServices();
        }
        return $this->services->count();

    }

    /**
     * @return void
     */
    private function setClient(){

        $client = $this->model->getClient();
        if($client instanceof ClientModel){
            $this->client = new Client($client);
        }

    }

    /**
     * @return void
     */
    private function setServices(){

        $this->services = $this->model->getProjectServices();

    }


}