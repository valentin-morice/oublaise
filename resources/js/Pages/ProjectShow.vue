<template>
    <div class="hero py-20 bg-base-200">
        <div class="hero-content gap-32 flex-col lg:flex-row">
            <div class="w-5/6">
                <div class="carousel shadow-lg w-full rounded-2xl">
                    <div v-for="image in images" :id="'item' + image.id" class="carousel-item w-full">
                        <img :src="'/' + image.path" class="w-full"/>
                    </div>
                </div>
                <div class="flex justify-center w-full py-2 gap-2">
                    <a v-for="(image, index) in images" :href="'#item' + image.id" class="btn btn-xs">
                        {{ index + 1 }}
                    </a>
                </div>
            </div>
            <div>
                <h1 class="text-3xl font-bold">{{ project.title }}</h1>
                <p class="py-6">{{ project.summary }}</p>
                <button class="btn btn-primary">Learn More</button>
            </div>
        </div>
    </div>
    <div class="container w-[1280px] mx-auto my-32">
        <section class="bg-base-200 rounded-2xl p-6 w-5/6 mx-auto">
            <div class="flex justify-between items-end">
                <h2 class="text-2xl font-bold">Collecté Jusqu'ici</h2>
                <p class="text-xl text-gray-600"><span class="text-2xl text-gray-700 font-bold pr-2">1046,53€</span>sur
                    un
                    objectif de<span
                        class="text-2xl font-bold pl-2 text-gray-700">{{ project.total_cost }}€</span></p>
            </div>
            <progress class="mt-6 progress progress-success w-full" value="10" max="100"></progress>
        </section>
        <section class="mt-24 px-2 w-5/6 mx-auto">
            <h2 class="text-2xl font-bold">Description</h2>
            <p class="mt-4 whitespace-pre-line">
                {{ project.description }}
            </p>
        </section>
        <section class="mt-24 bg-base-200 rounded-2xl p-6 w-5/6 mx-auto">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4 ml-2">
                    <ion-icon name="heart-outline" class="text-4xl rounded-xl"></ion-icon>
                    <h2 class="text-2xl font-bold">Soutenir Ce Projet</h2>
                </div>
                <div class="flex gap-2">
                    <button class="btn btn-secondary w-52">Poser une Question</button>
                    <button class="btn btn-primary w-40">Faire un Don</button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Base from "./Layout/Base";

export default {
    layout: Base,
    props: ['project', 'images'],
    data() {
        return {
            base: 1
        }
    }
}
</script>
