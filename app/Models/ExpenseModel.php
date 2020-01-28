<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model {

    protected $table = 'expenses';

    /**
     * @return ExpenseModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getExpenses(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getExpenseById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getExpenseType(){

        return $this->hasOne('App\Models\ExpenseTypeModel', 'id', 'expense_type_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getWorkpart(){

        return $this->hasOne('App\Models\WorkPartModel', 'id', 'workpart_id');

    }
}
