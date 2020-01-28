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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProject(){

        return $this->hasOne('App\Models\ProjectModel', 'id', 'project_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUnit(){

        return $this->hasOne('App\Models\UnitModel', 'id', 'unit_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getService(){

        return $this->hasOne('App\Models\ServiceModel', 'id', 'service_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getIncomes(){

        return $this->hasMany('App\Models\IncomeModel', 'project_service_id', 'id');

    }
}
