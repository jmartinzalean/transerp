<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = 'cities';

    public function getCities(){

        return self::all();

    }

    /**
     * @param $id
     * @return self
     */
    public function getCityById($id){

        return self::find($id);

    }

    /**
     * @return StateModel|\Illuminate\Database\Eloquent\Collection
     */
    public function getState(){

        return $this->hasOne('App\Models\StateModel','id','state_id')->get();

    }


    /**
     * @return ClientModel|\Illuminate\Database\Eloquent\Collection
     */
    public function getClients(){

        return $this->hasMany('App\Models\ClientModel', 'city_id', 'id')->get();

    }

    /**
     * @return EmployeModel|\Illuminate\Database\Eloquent\Collection
     */
    public function getEmployees(){

        return $this->hasMany('App\Models\EmployeModel', 'city_id', 'id')->get();

    }



}
