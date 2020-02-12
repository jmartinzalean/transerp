<?php
/**
 * Created by PhpStorm.
 * User: jamartin.sanz
 * Date: 29/11/2019
 * Time: 10:36
 */

namespace App\Transformers;

use App\Entities\Project;
use App\Models\ProjectModel;
use League\Fractal\TransformerAbstract;

class ProjectsTransformer extends TransformerAbstract {

    /**
     * @param ProjectModel $projectModel
     * @return array
     */
    public function transform(ProjectModel $projectModel) {

        $project = new Project($projectModel);

        return [
            'id' => $project->getId(),
            'name' => ucwords($project->getName()),
            'client_id' => $project->getClientId(),
            'client_name' => ucwords($project->getClient()->getName()),
            'date_start' => $project->getDateStart(),
            'date_end' => $project->getDateEnd(),
            'status' => ($project->getStatus()),
            'description' => $project->getDescription(),
            'servicescount' => $project->countServices()
        ];

    }


}
