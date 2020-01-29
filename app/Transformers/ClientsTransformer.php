<?php
/**
 * Created by PhpStorm.
 * User: jamartin.sanz
 * Date: 29/11/2019
 * Time: 10:36
 */

namespace App\Transformers;

use App\Entities\Client;
use App\Models\ClientModel;
use League\Fractal\TransformerAbstract;

class ClientsTransformer extends TransformerAbstract {

    /**
     * @param ClientModel $clientModel
     * @return array
     */
    public function transform(ClientModel $clientModel) {

        $client = new Client($clientModel);

        $city = array('name' => 'sin asignar', 'id' => 0);
        $state = $city;
        if($client->getCity()){
            $city = array(
                'id' => $client->getCity()->getAttribute('id'),
                'name' => $client->getCity()->getAttribute('name')
            );
            $state = array(
                'id' => $client->getState()->getAttribute('id'),
                'name' => $client->getState()->getAttribute('name')
            );
        }

        return [
            'id' => $client->getId(),
            'name' => $client->getName(),
            'tax_number' => $client->getTaxNumber(),
            'contact_name' => $client->getContactName(),
            'address' => $client->getAddress(),
            'cp' => $client->getCp(),
            'latitude' => $client->getLatitude(),
            'longitude' => $client->getLongitude(),
            'phone' => $client->getPhone(),
            'mobil' => $client->getMobil(),
            'fax' => $client->getFax(),
            'email' => $client->getEmail(),
            'description' => $client->getDescription(),
            'city' => $city,
            'state' => $state,
            'projectscount'=> $client->countProjects()
        ];

    }


}
