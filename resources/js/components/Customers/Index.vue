<template>
    <div>
        <h1>Customers</h1>
        <table class="table-auto">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {

    name: "Index",

    data() {
        return {
            customers: []
        }
    },

    mounted() {
        axios
            .get('api/customers')
            .then(response => {
                this.customers = response.data.data
            })
    }
}

</script>
