<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';

    /**
     * @return ProjectModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjects(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getProjectById($id){

        return self::find($id);

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProjectService(){

        return $this->hasMany('App\Models\ProjectServiceModel', 'project_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getClient(){

        return $this->hasOne('App\Models\ClientModel', 'id', 'client_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getWorkParts(){

        return $this->hasMany('App\Models\WorkPartModel', 'project_id', 'id');

    }
}
