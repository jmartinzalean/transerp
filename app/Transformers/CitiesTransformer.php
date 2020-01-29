<?php
/**
 * Created by PhpStorm.
 * User: jamartin.sanz
 * Date: 29/11/2019
 * Time: 10:36
 */

namespace App\Transformers;

use App\Models\CityModel;
use League\Fractal\TransformerAbstract;

class CitiesTransformer extends TransformerAbstract {

    /**
     * @param CityModel $cityModel
     * @return array
     */
    public function transform(CityModel $cityModel) {

        return [
            'id' => $cityModel->getAttribute('id'),
            'name' => $cityModel->getAttribute('name'),
        ];

    }


}
