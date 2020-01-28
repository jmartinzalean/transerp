<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckModel extends Model
{
    protected $table = 'trucks';


    /**
     * @return TruckModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTrucks(){

        return self::all();

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTruckById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getWorkPartsTrucks(){

        return $this->hasMany('App\Models\WorkPartTruckModel', 'truck_id', 'id');

    }
}
