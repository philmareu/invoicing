<template>
    <div class="p-8">
        <div class="mx-auto sm:max-w-sm">
            <h1 class="text-3xl mb-3">Install</h1>
            <div class="p-8 rounded-sm bg-orange-100">
                <form>
                    <div class="mb-3">
                        <label for="name" class="block mb-2">Name</label>
                        <input type="text" name="name" id="name" class="block w-full" v-model="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" name="email" id="email" class="block w-full" v-model="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block mb-2">Password</label>
                        <input type="password" name="password" id="password" class="block w-full" v-model="password">
                    </div>

                    <div class="mb-3">
                        <button type="button" class="p-2 bg-orange-400" @click="install()">Install</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    name: "Install",

    data() {
        return {
            name: null,
            email: null,
            password: null
        }
    },

    methods: {
        install() {
            axios
                .post('api/installations', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
            .then(response => {
                window.location = '/'
            })
        }
    },
}

</script>
