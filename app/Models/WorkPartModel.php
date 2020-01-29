<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WorkPartModel extends Model
{

    protected $table = 'workparts';

    /**
     * @return WorkPartModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getWorkParts(){

        return self::all();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getWorkPartById($id){

        return self::find($id);

    }

    /**
     * @return WorkPartTruckModel[]|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getWorkPartsTrucks(){

        return $this->hasMany('App\Models\WorkPartTruckModel', 'workpart_id', 'id');

    }

    /**
     * @return IncomeModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getIncomes(){

        return $this->hasMany('App\Models\IncomeModel', 'workpart_id', 'id')->get();

    }


    /**
     * @return ExpenseModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getExpenses(){

        return $this->hasMany('App\Models\ExpenseModel', 'workpart_id', 'id')->get();

    }

    /**
     * @return ProjectModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getProject(){

        return $this->hasOne('App\Models\ProjectModel','id', 'project_id')->first();

    }

    /**
     * @return EmployeModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getEmploye(){

        return $this->hasOne('App\Models\EmployeModel','id', 'employe_id')->first();

    }

    /**
     * @return User|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getCreatedUser(){

        return $this->hasOne('App\User','id', 'created_user_id')->first();

    }
}
