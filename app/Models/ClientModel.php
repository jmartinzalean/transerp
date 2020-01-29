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

        $this->getProjects()->where('projects.id','=',$id);

    }

}
