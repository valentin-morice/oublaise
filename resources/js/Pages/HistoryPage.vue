<template>
    <div class="hero py-16 bg-base-200">
        <div class="hero-content lg:px-32 flex-col lg:flex-row">
            <img class="max-w-sm rounded-lg shadow-2xl" src="/img/castle_old.jpg"/>
            <div class="lg:ml-12 lg:text-left lg:mt-0 mt-4 text-center">
                <h1 class="text-3xl lg:text-5xl font-bold">Lorem Ipsum</h1>
                <p class="pt-6 md:px-32 lg:px-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda autem cum dolorum,
                    fugiat harum in inventore, laudantium minus obcaecati odit porro repellat sint sit velit!
                </p>
            </div>
        </div>
    </div>
    <div class="pb-32 py-28 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 px-4 lg:px-20 items-center gap-x-16">
            <div class="order-2 lg:order-1 md:px-24 lg:px-0 mb-24 lg:mb-0">
                <ion-icon class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                          name="home-outline"></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">Lorem Ipsum</h2>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium asperiores eum ex
                    fugiat incidunt itaque numquam sint unde. A cum incidunt.
                </p>
            </div>
            <div class="order-2 lg:order-1 md:px-24 lg:px-0 mb-24 lg:mb-0">
                <ion-icon class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                          name="medal-outline"></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">Lorem Ipsum</h2>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium asperiores eum ex
                    fugiat incidunt itaque numquam sint unde. A cum incidunt necessitatibus nesciunt.
                </p>
            </div>
            <div class="order-2 lg:order-1 md:px-24 lg:px-0">
                <ion-icon class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                          name="star-outline"></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">Lorem Ipsum</h2>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium asperiores eum ex
                    fugiat incidunt itaque numquam sint unde. A cum incidunt necessitatibus.
                </p>
            </div>
        </div>
    </div>
    <div class="bg-base-200 py-32 lg:px-16">
        <div class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4">
            <div class="order-2 lg:order-1 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">Lorem Ipsum</h2>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium asperiores eum ex
                    fugiat incidunt itaque numquam sint unde. A cum incidunt necessitatibus nesciunt nihil omnis
                    perferendis
                    sit soluta voluptates.
                </p>
            </div>
            <img
                class="order-1 max-w-xs lg:order-2 md:max-w-sm mb-12 lg:mb-0 md:mb-24 lg:ml-auto lg:mr-0 mx-auto rounded-lg shadow-2xl"
                src="/img/cows.jpg"/>
        </div>
    </div>
    <div class="py-32 lg:px-16">
        <div class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4">
            <div class="order-2 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">Lorem Ipsum</h2>
                <p class="pt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium asperiores eum ex
                    fugiat incidunt itaque numquam sint unde. A cum incidunt necessitatibus nesciunt nihil omnis
                    perferendis
                    sit soluta voluptates.
                </p>
            </div>
            <img
                class="order-1 max-w-xs md:max-w-sm mb-12 lg:mb-0 mx-auto md:mb-24 lg:mr-auto lg:ml-0 rounded-lg shadow-2xl"
                src="/img/forest.jpg"/>
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";

export default {
    layout: Base
}
</script>
