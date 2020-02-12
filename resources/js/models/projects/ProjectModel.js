import {Model} from "vue-mc";
import {
    integer,
    required,
    string,
    not,
    min,
    date,
    after,
    equals,
    boolean,
    isnull,
    length
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
            status: 0,
            description: null,
            servicescount: 0
        }
    }

    mutations() {
        return {
            id:   (id) => Number(id) || 0,
            name: String,
            client_id:   (client_id) => Number(client_id) || 0,
            status : Number
        }
    }

    validation() {
        return {
            id:   integer.and(min(0)),
            name: required.and(string.and(length(1,20))),
            client_id: required.and(integer.and(not(0))),
            date_start: isnull.or(date),
            date_end: isnull.or(date.and(after(this.date_start))),
            status : boolean.or(equals(0).or(equals(1)))
        }
    }

    options() {
        return {
            validateOnChange: true,
            validateOnSave: true,
            validateRecursively: true,
            methods : {
                update:  "PUT"
            }
        }
    }

    routes() {
        return {
            fetch:  "api/projects/{id}",
            save:   "api/projects"
        }
    }

}

export default ProjectModel;