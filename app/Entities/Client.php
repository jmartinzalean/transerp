<?php

namespace App\Entities;


use App\Models\CityModel;
use App\Models\ClientModel;
use App\Models\ProjectModel;
use App\Models\StateModel;
use Illuminate\Database\Eloquent\Collection;

class Client {

    /** @var ClientModel $model */
    private $model;

    /** @var null|CityModel $city  */
    private $city = null;

    /** @var bool|null|StateModel $state  */
    private $state = null;
    /** @var null|ProjectModel[]|Collection */
    private $projects = null;

    /**
     * Client constructor.
     * @param ClientModel $clientModel
     */
    public function __construct(ClientModel $clientModel) {

        $this->model = $clientModel;

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
    public function getTaxNumber(){

        return $this->model->getAttribute('tax_number');

    }

    /**
     * @return mixed
     */
    public function getContactName(){

        return $this->model->getAttribute('contact_name');

    }

    /**
     * @return mixed
     */
    public function getAddress(){

        return $this->model->getAttribute('address');

    }

    /**
     * @return mixed
     */
    public function getCp(){

        return $this->model->getAttribute('cp');

    }

    /**
     * @return mixed
     */
    public function getId(){

        return $this->model->getAttribute('id');

    }

    /**
     * @return mixed
     */
    public function getLatitude(){

        return $this->model->getAttribute('latitude');

    }

    /**
     * @return mixed
     */
    public function getLongitude(){

        return $this->model->getAttribute('longitude');

    }

    /**
     * @return mixed
     */
    public function getPhone(){

        return $this->model->getAttribute('phone_number');

    }

    /**
     * @return mixed
     */
    public function getMobil(){

        return $this->model->getAttribute('mobil_number');

    }

    /**
     * @return mixed
     */
    public function getFax(){

        return $this->model->getAttribute('fax_number');

    }

    /**
     * @return mixed
     */
    public function getEmail(){

        return $this->model->getAttribute('email');

    }

    /**
     * @return mixed
     */
    public function getDescription(){

        return $this->model->getAttribute('description');

    }

    /**
     * @return CityModel|null
     */
    public function getCity(){

        if(is_null($this->city)){
            $this->setCityState();
        }
        if(!$this->city){
            return $this->city;
        }
        return $this->city;

    }

    /**
     * @return CityModel|StateModel|bool|null
     */
    public function getState(){

        if(is_null($this->city)){
            $this->setCityState();
        }
        if(!$this->city){
            return $this->city;
        }
        return $this->state;

    }

    /**
     * @return ProjectModel[]|Collection|null
     */
    public function getProjects(){
        if(is_null($this->projects)){
            $this->setProjects();
        }
        return $this->projects;
    }

    /**
     * @return bool
     */
    public function hasProjects(){

        return ($this->countProjects() > 0);
    }

    /**
     * @return int
     */
    public function countProjects(){

        if(is_null($this->projects)){
            $this->setProjects();
        }
        return $this->projects->count();
    }

    /**
     * @return void
     */
    private function setProjects(){

        $this->projects = $this->model->getProjects();

    }

    /**
     * @return void
     */
    private function setCityState(){

        $this->city = false;

        if(!is_null($this->model->getAttribute('city_id'))){
            $this->city = $this->model->getCity();
            $this->state = $this->city->getState();
        }

    }



}