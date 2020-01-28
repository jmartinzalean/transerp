<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = 'services';

    /**
     * @return ServiceModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getServices(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getServiceById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProjectsServices(){

        return $this->hasMany('App\Models\ProjectServiceModel', 'service_id', 'id');

    }
}
