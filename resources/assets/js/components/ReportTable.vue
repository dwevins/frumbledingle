<template>
    <div>
        <form @submit.prevent="getResults">
            <div class="filter-results-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Minimum Price</span>
                </div>
                <input v-model="price" type="number" class="form-control"/>

                <div class="input-group-append">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="row in results" :key="row.id">
                    <td>{{ row.location }}</td>
                    <td>{{ row.parent }}</td>
                    <td>{{ row.category }}</td>
                    <td>{{ row.count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            price: 0,
            results: []
        }
    },
    mounted() {
        this.getResults(this.price);
    },
    methods: {
        getResults() {
            return axios.get('/api/report', { 
                params: {
                    price: this.price
                    } 
                })
                .then(response => {
                    this.results = response.data;
                }).catch(console.error);
        }
    }
}
</script>

<style>
.filter-results-form {
  margin-bottom: 10px;
}
</style>
