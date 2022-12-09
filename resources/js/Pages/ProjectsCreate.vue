<template>
    <div class="min-h-screen bg-base-200 flex items-center justify-center flex-col">
        <div class="mx-2 py-8">
            <h1 class="text-2xl font-bold mb-6" v-if="!update">Create a New Project</h1>
            <h1 class="text-2xl font-bold mb-6" v-else>Update a Project</h1>
            <form @submit.prevent="!update ? submit() : submit_update()"
                  class="p-8 bg-white shadow-lg rounded-2xl w-[340px] md:w-[550px]">
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
                <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.description">
                    {{ form.errors.description }}</p>
                <div v-if="update" class="overflow-x-auto border-2 mt-4 text-sm rounded-[10px]">
                    <table class="table w-full">
                        <thead>
                        <tr>
                            <th>Images</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="image in images">
                            <td>
                                <div class="flex justify-between items-center">
                                    <img class="h-10" :src="'/' + image.path">
                                    <Link as="button" :data="image.id" href="/images/upload" method="delete">
                                        <ion-icon class="text-left mr-2 text-2xl text-red-600"
                                                  name="close-outline"></ion-icon>
                                    </Link>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <FilePond name="images"
                          class="mt-4 cursor-pointer"
                          ref="pond"
                          label-idle="Click or drop images here..."
                          :allow-multiple="true"
                          accepted-file-types="image/jpeg, image/png"
                          :credits="false"
                >
                    <p class="text-sm text-red-500 mt-1 ml-0.5" v-if="form.errors.images_id">
                        {{ form.errors.images_id }}</p>
                </FilePond>

                <button type="submit" class="btn btn-primary mt-4 w-full">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import AdminLayout from "./Layout/AdminLayout";
import {useForm} from "@inertiajs/inertia-vue3";
import CurrencyInput from "./Components/CurrencyInput";
import vueFilePond, {setOptions} from "vue-filepond"
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import "filepond/dist/filepond.min.css";
import {Link} from "@inertiajs/inertia-vue3";

const FilePond = vueFilePond(FilePondPluginFileValidateType);

setOptions({
    server: {
        process: {
            url: '/images/upload',
            onload: (response) => {
                id_arr.push(JSON.parse(response).id)
                return JSON.parse(response).id
            }
        },
        revert: {
            url: '/images/upload',
        },
    }
})

let id_arr = []

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
                id: this.id,
                images_id: id_arr
            }),
        }
    },
    components: {
        CurrencyInput,
        FilePond,
        Link
    },
    props: ['title', 'cost', 'summary', 'description', 'update', 'id', 'images']
}
</script>
