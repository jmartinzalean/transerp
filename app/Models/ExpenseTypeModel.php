<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseTypeModel extends Model
{
    protected $table = 'expenses_types';

    /**
     * @return ExpenseTypeModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getExpensesTypes(){

        return self::all();

    }

    /**
     * @param int $id
     * @return self
     */
    public function getExpenseTypeById($id){

        return self::find($id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getExpenses(){

        return $this->hasMany('App\Models\ExpenseModel', 'expense_type_id', 'id');

    }
}
