<template>
    <div class="bg-base-200 flex items-center justify-center h-screen">
        <div class="shadow-lg bg-white max-w-md mx-2 p-4 rounded-xl">
            <h1 class="font-bold text-xl text-gray-700 mb-4">Login</h1>
            <form @submit.prevent="submit">
                <input
                    v-model="form.email"
                    class="mt-3 input input-bordered w-full"
                    name="email"
                    placeholder="Your Email"
                    type="email">
                <p v-if="form.errors.email" class=" mt-1 text-sm text-red-500">{{ form.errors.email }}</p>
                <input
                    v-model="form.password"
                    class="mt-3 input input-bordered w-full"
                    name="password"
                    placeholder="Password"
                    type="password">
                <p v-if="form.errors.password" class=" mt-1 text-sm text-red-500">{{ form.errors.password }}</p>
                <div class="grid grid-cols-2 mt-4 gap-2">
                    <Link
                        class="btn btn-secondary"
                        href="/"
                    >Go Back
                    </Link>
                    <button
                        class="btn btn-primary w-full"
                        type="submit">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    setup() {
        const form = useForm({
            email: '',
            password: '',
        })
        return {form}
    },
    methods: {
        submit() {
            this.form.post('/login');
        }
    },
    components: {
        Link
    }
}
</script>

