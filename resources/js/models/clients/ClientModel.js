import {Model} from "vue-mc";
import {
    integer,
    required,
    string,
} from 'vue-mc/validation'

class ClientModel extends Model{

    defaults(){

        return{
            id:0,
            name:'',
            tax_number:'',
            contact_name:'',
            address:'',
            cp:null,
            latitude:0,
            longitude:0,
            phone:null,
            mobil:null,
            fax:null,
            email:null,
            description:'',
            city:{id:0,name:''},
            state:{id:0,name:''},
            projectscount:0
        }
    }

    mutations() {
        return {
            id:   (id) => Number(id) || 0,
            name: String,
            tax_number:   String,

        }
    }

    validation() {
        return {
            id:   integer.and(min(0)),
            name: required.and(string),
            tax_number: required.and(string),
        }
    }

    routes() {
        return {
            fetch:  "api/clients/{id}",
            save:   "api/clients"
        }
    }

}

export default ClientModel;