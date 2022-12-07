<template>
    <div class="min-h-screen bg-base-200 flex items-center justify-center flex-col">
        <div class="mx-2">
            <h1 class="text-2xl font-bold mb-6" v-if="!update">Create a New Project</h1>
            <h1 class="text-2xl font-bold mb-6" v-else>Update a Project</h1>
            <form @submit.prevent="!update ? submit() : submit_update()"
                  class="p-8 bg-white rounded-2xl w-[340px] md:w-[550px]">
                <input v-model="form.title" type="text" placeholder="Project Title" class="input w-full input-bordered">
                <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.title">{{ form.errors.title }}</p>
                <input v-model="form.summary" type="text" placeholder="Summary"
                       class="input w-full input-bordered mt-4">
                <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.summary">{{ form.errors.summary }}</p>
                <CurrencyInput
                    v-model.number="form.cost"
                    :options="{ currency: 'EUR', autoDecimalDigit: true, precision: 2 }"
                    class="input input-bordered w-full mt-4"
                    placeholder="Montant"
                />
                <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.cost">{{ form.errors.cost }}</p>
                <textarea v-model="form.description" rows="6"
                          class="placeholder:text-base text-base resize-none textarea textarea-bordered w-full mt-4"
                          placeholder="Description"></textarea>
                <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.description">{{
                        form.errors.description
                    }}</p>
                <button type="submit" class="btn btn-primary mt-4 w-full">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import AdminLayout from "./Layout/AdminLayout";
import {useForm} from "@inertiajs/inertia-vue3";
import CurrencyInput from "./Components/CurrencyInput";

export default {
    layout: AdminLayout,
    methods: {
        submit() {
            this.form.post('/admin/projects/create')
        },
        submit_update() {
            this.form.put('/admin/projects/edit/' + this.id)
        }
    },
    data() {
        return {
            form: useForm({
                title: this.title,
                summary: this.summary,
                cost: this.cost,
                description: this.description,
                id: this.id
            }),
        }
    },
    components: {
        CurrencyInput
    },
    props: ['title', 'cost', 'summary', 'description', 'update', 'id']
}
</script>
