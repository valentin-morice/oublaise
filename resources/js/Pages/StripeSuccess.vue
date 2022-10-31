<template>
    <div class="bg-base-200 px-2 lg:px-0 py-8">
        <div class="bg-white shadow-lg md:w-2/3 lg:w-1/3 mx-auto p-4 rounded-xl">
            <ion-icon
                class="mx-auto block py-2 text-6xl text-gray-700"
                :name="
                    data.status === 'succeeded' || data.status === 'processing'
                        ? 'checkmark-circle-outline'
                        : 'close-circle-outline'
                "
            ></ion-icon>
            <h1 v-if="data.status === 'succeeded' || data.status === 'processing'"
                class="text-center pt-3 font-bold text-xl text-gray-700 mb-2">
                Payment Effectué
            </h1>
            <h1 v-else class="text-center pt-3 font-bold text-xl text-gray-700 mb-2">
                Veuillez Réessayer
            </h1>
            <p class="text-center" v-if="data.status === 'succeeded'">
                Nous avons reçu votre paiement.
            </p>
            <p class="text-center" v-else-if="data.status === 'processing'">
                Votre paiement est en cours de traitement.
            </p>
            <p
                class="text-center"
                v-else-if="data.status === 'requires_payment_method'"
            >
                Le paiement a échoué. Essayez un autre moyen de paiement.
            </p>
            <p class="text-center" v-else>Un erreur s'est produite.</p>
            <div class="bg-gray-100">
                <div class="items-center flex justify-between px-3 pt-2 mt-8 border-t">
                    <p class="text-sm text-gray-600">Montant</p>
                    <p class="text-sm text-gray-600">€{{ displayAmount(data.amount) }}</p>
                </div>
                <div class="items-center flex justify-between px-3 mt-3">
                    <p class="text-sm text-gray-600">Nom</p>
                    <p class="text-sm text-gray-600">{{ data.customer }}</p>
                </div>
                <div class="items-center flex justify-between px-3 mt-3 pb-3">
                    <p class="text-sm text-gray-600">Réference Paiement</p>
                    <p class="text-sm text-gray-600">{{ data.paymentId }}</p>
                </div>
            </div>
            <Link href="/">
                <button
                    class="bg-blue-500 w-full mt-8 block hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Retour à l'Accueil
                </button>
            </Link>
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    layout: Base,
    props: ['data'],
    methods: {
        displayAmount(amount) {
            if (this.countDecimals(amount) === 2) {
                return amount
            } else if (this.countDecimals(amount) === 1) {
                return amount + '0'
            } else if (this.countDecimals(amount) === 0) {
                return amount + '.00'
            }
        },
        countDecimals(value) {
            if (Math.floor(value) === value) return 0;
            return value.toString().split(".")[1].length || 0;
        },
    },
    components: {
        Link
    }
}
</script>
