<?php

namespace App\Models;

use App\User;
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
     * @return EmployeModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getCity(){

        return $this->hasOne('App\Models\EmployeModel', 'id', 'city_id')->first();

    }


    /**
     * @return User|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getUser(){

        return $this->hasOne('App\User', 'id', 'user_id')->first();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getWorkParts(){

        return $this->hasMany('App\Models\WorkpartModel', 'employe_id', 'id');

    }
}
