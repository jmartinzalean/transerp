<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPartTruckModel extends Model
{
    protected $table = 'workparts_trucks';

    /**
     * @return WorkPartTruckModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getWorkPartsTrucks(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getWorkPartTruckById($id){

        return self::find($id);

    }


    /**
     * @return TruckModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getTruck(){

        return $this->hasOne('App\Models\TruckModel', 'id', 'truck_id')->first();

    }


    /**
     * @return WorkPartModel|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getWorkPart(){

        return $this->hasOne('App\Models\WorkPartModel', 'id', 'workpart_id')->first();

    }

}
