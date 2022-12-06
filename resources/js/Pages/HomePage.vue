<template>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content md:py-20 lg:py-0 gap-8 md:gap-32 flex-col lg:flex-row">
            <img class="max-w-xs md:max-w-md rounded-lg shadow-2xl" src="/img/castle_portrait.jpg"/>
            <div class="lg:ml-12 lg:text-left lg:mt-0 mt-4 text-center">
                <h1 class="text-3xl lg:text-5xl font-bold">Domaine d'Oublaise</h1>
                <p class="py-6 md:px-32 lg:px-0">
                    Découvrez un domaine d’exception, qui a su se démarquer à travers les âges. Oublaise et son domaine
                    sont un havre de paix situé au coeur de l'Indre.
                </p>
                <Link href="/history">
                    <button class="btn btn-primary">En Savoir Plus</button>
                </Link>
            </div>
        </div>
    </div>
    <div class="container mx-auto my-32 lg:px-16 px-4">
        <div class="lg:px-64 md:px-16 lg:text-center">
            <h2 class="lg:text-4xl text-3xl font-bold">Une Expérience Unique</h2>
            <p class="pt-6">
                Le château d’Oublaise constitue un héritage remarquable. Vieux de plusieurs siècles, il a abrité au fil
                du temps nombre de différentes familles et communautés. Apprenez-en plus sur son histoire, et participez
                à sa conservation dès à présent
            </p>
        </div>
    </div>
    <div class="bg-base-200 py-32 lg:px-16">
        <div class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4">
            <div class="order-2 lg:order-1 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">À Propos</h2>
                <p class="pt-3">
                    S’étendant sur une surface de plus de quatre-vingt hectares, le domaine d’Oublaise est d’une nature
                    polyvalente. Ses terres cultivables sont présentement exploitées par les propriétaires, et le
                    château abrite un temple Hare Krishna accueillant chaque jour de nombreux visiteurs.
                </p>
            </div>
            <img
                class="order-1 max-w-xs md:max-w-md lg:order-2 mb-12 lg:mb-0 md:mb-24 lg:ml-auto lg:mr-0 mx-auto rounded-lg shadow-2xl"
                src="/img/clean_field.jpeg"/>
        </div>
    </div>
    <div class="py-32 lg:px-16">
        <div class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4">
            <div class="order-2 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">Le Château Aujourd’hui</h2>
                <p class="pt-3">
                    De nombreuses rénovations sont aujourd’hui nécessaires pour préserver tant le château que le domaine
                    qui lui est associé, pour garantir la sécurité des invités et permettre aux generations futures de
                    bénéficier de ce lieu hors-norme.
                </p>
            </div>
            <img
                class="order-1 max-w-xs md:max-w-md mb-12 lg:mb-0 mx-auto md:mb-24 lg:mr-auto lg:ml-0 rounded-lg shadow-2xl"
                src="/img/castle_outside.jpg"/>
        </div>
    </div>
    <div class="hero py-32 bg-base-200">
        <div class="hero-content flex-col gap-32 lg:flex-row-reverse">
            <div class="lg:ml-10 md:px-24 mb-8 lg:mb-0 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">Nous Contacter</h2>
                <p class="py-3">
                    Vous avez une question, une suggestion, où souhaitez engager votre temps au service du domaine ?
                    N'hésitez pas à nous contacter via le formulaire ci-contre.
                </p>
            </div>
            <div class="card flex-shrink-0 w-full max-w-xs sm:max-w-sm md:max-w-md shadow-2xl bg-base-100">
                <form class="card-body" @submit.prevent="submit">
                    <div v-if="$page.props.flash.message"
                         class="alert alert-success mb-2">
                        <div>
                            <svg class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"/>
                            </svg>
                            <span>{{ $page.props.flash.message }}</span>
                        </div>
                    </div>
                    <div class="form-control">
                        <input v-model="form.name" class="input input-bordered" name="name" placeholder="Nom"
                               type="text"/>
                    </div>
                    <p v-if="form.errors.name" class="-mt-1 text-sm text-red-500">{{ form.errors.name }}</p>
                    <div class="form-control mt-2">
                        <input v-model="form.email" class="input input-bordered" name="email" placeholder="Email"
                               type="text"/>
                    </div>
                    <p v-if="form.errors.email" class="-mt-1 text-sm text-red-500">{{ form.errors.email }}</p>
                    <div class="form-control mt-2">
                        <textarea v-model="form.message"
                                  class="textarea text-base textarea-bordered placeholder:text-base resize-none"
                                  name="message"
                                  placeholder="Message" rows="4"></textarea>
                    </div>
                    <p v-if="form.errors.message" class="-mt-1 text-sm text-red-500">{{ form.errors.message }}</p>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";
import {Link, useForm} from "@inertiajs/inertia-vue3";

export default {
    layout: Base,
    methods: {
        submit() {
            this.form.post('/contact', {
                preserveScroll: true,
                onSuccess: () => this.form.reset('name', 'email', 'message'),
            })
        },
    },
    setup() {
        const form = useForm({
            name: '',
            email: '',
            message: '',
        })
        return {form}
    },
    components: {
        Link
    },
}
</script>
