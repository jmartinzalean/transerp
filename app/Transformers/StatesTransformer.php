<?php
/**
 * Created by PhpStorm.
 * User: jamartin.sanz
 * Date: 29/11/2019
 * Time: 10:36
 */

namespace App\Transformers;

use App\Models\StateModel;
use League\Fractal\TransformerAbstract;

class StatesTransformer extends TransformerAbstract {

    /**
     * @param StateModel $stateModel
     * @return array
     */
    public function transform(StateModel $stateModel) {

        return [
            'id' => $stateModel->getAttribute('id'),
            'name' => ucwords($stateModel->getAttribute('name')),
        ];

    }


}
