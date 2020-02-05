<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{

    protected $table = 'clients';

    /**
     * @return ClientModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getClients(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getClientById($id){

        return self::find($id);

    }


    /**
     * @param string $name
     * @return ClientModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getClientByName($name){

        return self::all()->where('name', '=', $name);

    }

    /**
     * @param string $nif
     * @return ClientModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getClientByNif($nif){

        return self::all()->where('tax_number', '=', $nif);

    }


    /**
     * @return CityModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getCity(){

        return $this->hasOne('App\Models\CityModel','id','city_id')->first();

    }

    /**
     * @return ProjectModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjects(){

        return $this->hasMany('App\Models\ProjectModel','client_id', 'id')->get();

    }

    /**
     * @param int $id
     */
    public function getProjectById($id){

        return $this->getProjects()->where('projects.id','=',$id);

    }

    public function getInstance($data = array()){

        return new self($data);

    }

}
