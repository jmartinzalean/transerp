<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeModel extends Model
{

    protected $table = 'employees';

    /**
     * @return EmployeModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEmployees(){

        return self::all();

    }

    /**
     * @param $id
     * @return self
     */
    public function getEmployeById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCity(){

        return $this->hasOne('App\Models\EmployeModel', 'id', 'city_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUser(){

        return $this->hasOne('App\User', 'id', 'user_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getWorkParts(){

        return $this->hasMany('App\Models\WorkpartModel', 'employe_id', 'id');

    }
}
