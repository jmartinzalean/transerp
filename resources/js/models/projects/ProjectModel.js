import {Model} from "vue-mc";
import {
    integer,
    required,
    string,
    not,
    min
} from 'vue-mc/validation'


class ProjectModel extends Model{

    defaults(){

        return{
            id: 0,
            name: "",
            client_id: 0,
            client_name: "",
            date_start: null,
            date_end: null,
            status: "",
            description: null,
            servicescount: 0
        }
    }

    mutations() {
        return {
            id:   (id) => Number(id) || 0,
            name: String,
            client_id:   (id) => Number(id) || 0,

        }
    }

    validation() {
        return {
            id:   integer.and(min(0)),
            name: string.and(required),
            client_id: integer.not(0)
        }
    }

    routes() {
        return {
            fetch:  "/projects/{id}",
            save:   "/projects"
        }
    }

}

export default ProjectModel;