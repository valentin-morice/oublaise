<template>
    <div class="hero py-20 bg-base-200">
        <div class="hero-content gap-32 flex-col lg:flex-row">
            <div class="w-5/6">
                <div class="carousel shadow-lg w-full rounded-2xl">
                    <div id="item1" class="carousel-item w-full">
                        <img src="https://placeimg.com/600/400/arch" class="w-full"/>
                    </div>
                    <div id="item2" class="carousel-item w-full">
                        <img src="https://placeimg.com/600/400/arch" class="w-full"/>
                    </div>
                    <div id="item3" class="carousel-item w-full">
                        <img src="https://placeimg.com/600/400/arch" class="w-full"/>
                    </div>
                    <div id="item4" class="carousel-item w-full">
                        <img src="https://placeimg.com/600/400/arch" class="w-full"/>
                    </div>
                </div>
                <div class="flex justify-center w-full py-2 gap-2">
                    <a href="#item1" class="btn btn-xs">1</a>
                    <a href="#item2" class="btn btn-xs">2</a>
                    <a href="#item3" class="btn btn-xs">3</a>
                    <a href="#item4" class="btn btn-xs">4</a>
                </div>
            </div>
            <div>
                <h1 class="text-5xl font-bold">Project Title</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                    exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
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
                        class="text-2xl font-bold pl-2 text-gray-700">12000€</span></p>
            </div>
            <progress class="mt-6 progress progress-success w-full" value="10" max="100"></progress>
        </section>
        <section class="mt-24 px-2 w-5/6 mx-auto">
            <h2 class="text-2xl font-bold">Description</h2>
            <p class="mt-6">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, atque cumque dignissimos impedit qui sint.
                Alias distinctio dolor doloribus laboriosam natus officia quia temporibus. Amet assumenda beatae cum
                delectus eveniet, ipsam nobis nostrum porro quia rem reprehenderit tempore vero? Alias delectus deserunt
                doloremque eaque hic laborum quaerat quia recusandae sed.
            </p>
            <p class="mt-6">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci asperiores blanditiis cum eius
                laudantium nihil obcaecati quam quisquam sapiente veritatis? Accusantium consequatur excepturi facere
                iure mollitia, perspiciatis provident soluta suscipit totam veritatis? Quidem, vel!
            </p>
            <p class="mt-6">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam culpa deleniti illo praesentium quidem
                quis sequi voluptates. Accusamus asperiores at aut blanditiis commodi consectetur corporis dolore
                doloremque esse eveniet expedita, fuga hic illo, ipsam magni maxime odit officiis perferendis quam sint
                vel veritatis vero! Aliquid commodi culpa cumque deserunt dolore earum et excepturi facilis fuga iure
                laboriosam nam nobis non obcaecati officiis qui quisquam, reprehenderit temporibus, unde velit
                voluptatibus, voluptatum!
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
}
</script>
