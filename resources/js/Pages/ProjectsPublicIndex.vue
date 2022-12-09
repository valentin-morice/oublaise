<template>
    <div class="bg-base-200 pt-16 pb-28 min-h-screen">
        <div class="container md:w-[600px] lg:w-[1280px] md:mx-auto">
            <h1 class="text-4xl mx-4 font-bold">Découvrez Nos Projets</h1>
            <div v-for="project in projects" class="card mx-4 mt-12 lg:card-side bg-base-100 shadow-xl">
                <figure><img class="object-cover" :src="'/' + project.images[0].path" alt="Album"/>
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ project.title }}</h2>
                    <p>{{ project.summary }}</p>
                    <div class="card-actions justify-end">
                        <Link :href="'/projects/' + project.id" class="btn btn-primary w-full lg:w-44 mt-4 lg:mt-0">
                            En Savoir Plus
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    layout: Base,
    props: ['projects'],
    components: {
        Link
    }
}
</script>
