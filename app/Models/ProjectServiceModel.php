<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectServiceModel extends Model
{
    protected $table = 'projects_services';

    /**
     * @return ProjectServiceModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjectsServices(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getProjectServiceById($id){

        return self::find($id);

    }


    /**
     * @return ProjectModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getProject(){

        return $this->hasOne('App\Models\ProjectModel', 'id', 'project_id')->first();

    }


    /**
     * @return UnitModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getUnit(){

        return $this->hasOne('App\Models\UnitModel', 'id', 'unit_id')->first();

    }


    /**
     * @return ServiceModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getService(){

        return $this->hasOne('App\Models\ServiceModel', 'id', 'service_id')->first();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getIncomes(){

        return $this->hasMany('App\Models\IncomeModel', 'project_service_id', 'id');

    }
}
