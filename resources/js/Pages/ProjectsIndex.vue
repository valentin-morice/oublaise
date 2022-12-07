<template>
    <div class="alert alert-success fixed bottom-4 right-4 w-[240px]" v-if="$page.props.flash.message">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ $page.props.flash.message }}</span>
        </div>
    </div>
    <div class="flex items-center justify-center flex-col h-screen bg-base-200" v-if="projects.length === 0">
        <ion-icon name="close-circle-outline" class="text-8xl text-gray-400 mb-16"></ion-icon>
        <p class="text-center">It looks like you haven't created a project yet.<br>Create one now!</p>
        <Link href="projects/create" class="btn btn-primary mt-12">Create a Project</Link>
    </div>
    <div v-else class="py-16 h-screen bg-base-200">
        <div class="bg-white rounded-2xl md:w-2/3 mx-1 md:mx-auto shadow-lg p-4 pb-8">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-xl pl-2 text-gray-700">All Projects</h1>
                <Link class="btn btn-secondary" href="projects/create">Create a Project</Link>
            </div>
            <div class="overflow-x-auto relative mt-4">
                <table class="w-full text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="py-3 px-6" scope="col">
                            Title
                        </th>
                        <th>Modify</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="project in projects.data"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6">
                            {{ project.title }}
                        </td>
                        <th class="text-blue-600">
                            <Link :href="'projects/edit/' + project.id">Edit</Link>
                        </th>
                        <th class="text-red-600">
                            <Link method="delete" as="button" :href="'projects/delete/' + project.id">Delete</Link>
                        </th>
                        <th class="text-gray-600">
                            <Link :href="'/projects/' + project.id">View</Link>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="md:w-2/3 mx-auto mt-8">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in projects.links"
                :class="link.url ? '' : 'text-gray-400', link.active ? 'border-2 border-indigo-500' : ''"
                :href="'/stripe' + link.url"
                class="py-2 px-3 rounded-[8px] bg-white m-1 shadow-lg"
                preserve-scroll
                v-html="link.label"
            />
        </div>
    </div>
</template>

<script>
import AdminLayout from "./Layout/AdminLayout";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    layout: AdminLayout,
    props: ['projects'],
    components: {
        Link
    }
}
</script>
