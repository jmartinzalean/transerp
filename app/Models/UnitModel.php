<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    protected $table = 'units';

    /**
     * @return UnitModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUnits(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getUnitById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProjectsServices(){

        return $this->hasMany('App\Models\ProjectServiceModel', 'unit_id', 'id');

    }
}
