<template>
    <div>
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
        this.getResults();
    },
    methods: {
        getResults() {
            return axios.get('/api/report')
                .then(response => {
                    this.results = response.data;
                    console.log(this.results);
                }).catch(console.error);
        }
    }
}
</script>
