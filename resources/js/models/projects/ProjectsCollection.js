import {Collection} from "vue-mc";
import Project from "../../models/projects/ProjectModel";

class ProjectsCollection extends Collection {

    model(){
        return Project;
    }

    // Default attributes
    defaults() {
        return {
            orderBy: 'name',
        }
    }

    // Route configuration
    routes() {
        return {
            fetch: 'api/projects',
        }
    }

    getModelsFromResponse(response) {
        return response.getData().projects
    }

    // Number of tasks to be completed.
    get todo() {
        return this.sum('done');
    }

    // Will be `true` if all tasks have been completed.
    get done() {
        return this.todo === 0;
    }
}

export default ProjectsCollection;