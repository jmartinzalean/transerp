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

    public function getState(){

        return $this->hasOne('App\Models\StateModel','id','state_id');

    }

    public function getClients(){

        return $this->hasMany('App\Models\ClientModel', 'city_id', 'id');

    }

    public function getEmployees(){

        return $this->hasMany('App\Models\EmployeModel', 'city_id', 'id');

    }



}
