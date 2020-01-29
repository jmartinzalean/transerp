<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeModel extends Model
{
    protected $table = 'incomes';

    /**
     * @return IncomeModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getIncomes(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getIncomeById($id){

        return self::find($id);

    }


    /**
     * @return ProjectServiceModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getProjectService(){

        return $this->hasOne('App\Models\ProjectServiceModel', 'id', 'project_service_id')->first();

    }


    /**
     * @return WorkPartModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getWorkpart(){

        return $this->hasOne('App\Models\WorkPartModel', 'id', 'workpart_id')->first();

    }
}
