<template>
    <div>
        <span>Items</span>
        <form @submit.prevent="createItem">
            <div class="create-item-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newItem.name" type="text" class="form-control" placeholder="Item Name" />

                <div class="input-group-prepend">
                    <span class="input-group-text">Category</span>
                </div>
                <input v-model="newItem.category" type="text" class="form-control" placeholder="Item Category" />

                <div class="input-group-prepend">
                    <span class="input-group-text">Location</span>
                </div>
                <input v-model="newItem.location" type="text" class="form-control" placeholder="Item Location" />

                <div class="input-group-prepend">
                    <span class="input-group-text">Price</span>
                </div>
                <input v-model="newItem.price" type="text" class="form-control" placeholder="Item Price" />

                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.category.name }}</td>
                    <td>{{ row.location.name }}</td>
                    <td>{{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

const DEFAULT_ITEM = {
    name: '',
    category: '',
    location: '',
    price: '',
};

export default {
    data() {
        return {
            items: [],
            newItem: {...DEFAULT_ITEM}
        };
    },
    mounted() {
        this.getItems();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        createItem() {
            return axios.post('/api/items', {...this.newItem})
                .then(this.getItems)
                .then(() => this.newItem = {...DEFAULT_ITEM})
                .catch(console.error);
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        }
    }
};
</script>

<style>
.create-item-form {
  margin-bottom: 10px;
}
</style>
