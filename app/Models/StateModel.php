<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    protected $table = 'states';

    /**
     * @return StateModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getStates(){

        return self::all();

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStateById($id){

        return self::find($id);

    }

    /**
     * @return CityModel|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function getCities(){

        return $this->hasMany('App\Models\CityModel', 'state_id', 'id')->first();

    }
}
