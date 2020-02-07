import {Collection} from "vue-mc";
import Client from "../../models/clients/ClientModel";

class ClientsCollection extends Collection {

    model(){
        return Client;
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
            fetch: 'api/clients',
        }
    }

    getModelsFromResponse(response) {
        return response.getData().clients
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

export default ClientsCollection;