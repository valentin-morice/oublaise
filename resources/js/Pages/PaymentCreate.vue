<template>


    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col gap-16 lg:flex-row-reverse">
            <div class="text-center lg:ml-4 lg:text-left">
                <h1 class="lg:text-5xl text-3xl font-bold">Faire un Don</h1>
                <p class="py-6 md:px-24 lg:px-0">
                    Le domaine est maintenu grâce aux génereux dons effectués tout au long de l'année par nos visiteurs.
                    Chaque contribution est grandement appréciée.
                </p>
            </div>
            <div class="shadow-lg bg-white md:w-1/2 mx-auto py-8 px-6 rounded-xl">
                <form @submit.prevent="submit">
                    <CurrencyInput
                        v-model.number="form.amount"
                        :options="{ currency: 'EUR', autoDecimalDigit: true, precision: 2 }"
                        class="input input-bordered w-full"
                        placeholder="Montant"
                    />
                    <p v-if="form.errors.amount" class=" mt-1 text-sm text-red-500">{{ form.errors.amount }}</p>
                    <input
                        v-model="form.first_name"
                        class="mt-3 input input-bordered w-full"
                        name="first_name"
                        pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$"
                        placeholder="Prénom"
                        type="text">
                    <p v-if="form.errors.first_name" class=" mt-1 text-sm text-red-500">{{ form.errors.first_name }}</p>
                    <input
                        v-model="form.last_name"
                        class="mt-3 input input-bordered w-full"
                        name="last_name"
                        pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$"
                        placeholder="Nom"
                        type="text">
                    <p v-if="form.errors.last_name" class=" mt-1 text-sm text-red-500">{{ form.errors.last_name }}</p>
                    <input
                        v-model="form.email"
                        class="mt-3 input input-bordered w-full"
                        name="email"
                        placeholder="Email"
                        type="email">
                    <p v-if="form.errors.email" class=" mt-1 text-sm text-red-500">{{ form.errors.email }}</p>
                    <button
                        :disabled="form.processing"
                        class="btn btn-primary w-full mt-6"
                        type="submit">Confirmer
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Base from './Layout/Base'
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import CurrencyInput from "./Components/CurrencyInput";

export default {
    layout: Base,
    components: {
        Link,
        CurrencyInput
    },
    setup() {
        const form = useForm({
            amount: null,
            first_name: '',
            last_name: '',
            email: '',
        })
        return {form}
    },
    data() {
        return {
            previousAmount: null,
        }
    },
    methods: {
        submit() {
            this.form.post('/payment/create')
        },
        handleInput(e) {
            let stringValue = e.target.value.toString()
            let regex = /^\d*(\.\d{1,2})?$/
            if (!stringValue.match(regex) && this.form.amount !== '') {
                this.form.amount = this.previousAmount
            }
            this.previousAmount = this.form.amount
        }
    }
}
</script>
