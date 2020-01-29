<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = 'cities';

    /**
     * @return CityModel[]|\Illuminate\Database\Eloquent\Collection
     */
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
     * @param $stateId
     * @return CityModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCitiesByStateId($stateId){

        return self::all()->where('state_id','like', $stateId);

    }


    /**
     * @return StateModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getState(){

        return $this->hasOne('App\Models\StateModel','id','state_id')->first();

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
