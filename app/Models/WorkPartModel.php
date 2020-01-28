<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPartModel extends Model
{

    protected $table = 'workparts';

    public function getWorkParts(){

        return self::all();

    }

    public function getWorkPartById($id){

        return self::find($id);

    }

    public function getWorkPartsTrucks(){

        return $this->hasMany('App\Models\WorkPartTruckModel', 'workpart_id', 'id');

    }

    public function getIncomes(){

        return $this->hasMany('App\Models\IncomeModel', 'workpart_id', 'id');

    }

    public function getExpenses(){

        return $this->hasMany('App\Models\ExpenseModel', 'workpart_id', 'id');

    }

    public function getProject(){

        return $this->hasOne('App\Models\ProjectModel','id', 'project_id');

    }

    public function getEmploye(){

        return $this->hasOne('App\Models\EmployeModel','id', 'employe_id');

    }

    public function getCreatedUser(){

        return $this->hasOne('App\User','id', 'created_user_id');

    }
}
