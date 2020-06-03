<template>
    <div>
        <form @submit.prevent="createCategory">
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newCategory.name" type="text" class="form-control" placeholder="Category Name" />

                <div class="input-group-prepend">
                    <span class="input-group-text">Parent</span>
                </div>
                <input v-model="newCategory.parentId" type="text" class="form-control" placeholder="Parent ID" />

                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.parent_id || 'NULL' }}</td>
                    <!-- <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteLocation(row.id)"><i class="fa fa-times" /> Delete</button></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

const DEFAULT_CAT = {
    name: '',
    parentId: null
};

export default {
    data() {
        return {
            categories: [],
            newCategory: {...DEFAULT_CAT}
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                    console.log(this.categories)
                }).catch(console.error);
        },
        createCategory() {
            return axios.post('/api/categories', {...this.newCategory})
                .then(this.getCategories)
                .then(() => this.newCategory = {...DEFAULT_CAT})
                .catch(console.error);
        }
    }
}
</script>