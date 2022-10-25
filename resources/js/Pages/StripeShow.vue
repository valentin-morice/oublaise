<template>
    <div class="bg-base-200 py-8 min-h-screen">
        <div class="bg-white md:w-2/3 mx-1 md:mx-auto p-4 rounded-xl shadow-lg">
            <div class="flex justify-between">
                <div class="ml-2">
                    <h1 class="font-bold text-xl text-gray-700">{{ customer_name }}</h1>
                    <div class="flex items-center mt-1">
                        <ion-icon class="text-xl text-gray-500" name="mail-outline"></ion-icon>
                        <p class="text-sm text-gray-500 ml-1">{{ customer_email }}</p>
                    </div>
                </div>
                <Link class="h-10 px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded text-white font-bold"
                      href="/stripe" preserve-scroll style="margin-top: 3px">« All Payments
                </Link>
            </div>
            <div class="overflow-x-auto relative mt-6">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="py-3 px-6" scope="col">
                            Payment ID
                        </th>
                        <th class="py-3 px-6" scope="col">
                            Date
                        </th>
                        <th class="py-3 px-6" scope="col">
                            Amount
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in data.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6 underline underline-offset-2">
                            <a :href="'https://dashboard.stripe.com/test/payments/' + payment.stripe_id"
                               target="_blank">
                                {{ payment.stripe_id }}
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            {{ payment.date }}
                        </td>
                        <td class="py-4 px-6">
                            €{{ displayAmount(payment.amount) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="md:w-2/3 mx-auto mt-8">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in data.links"
                :class="link.url ? '' : 'text-gray-400', link.active ? 'border-2 border-indigo-500' : ''"
                :href="'/stripe/' + customer_id + link.url"
                class="py-2 px-3 rounded bg-white m-1 shadow-lg"
                v-html="link.label"
            />
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import Base from "./Layout/Base";
import AdminLayout from "./Layout/AdminLayout";

export default {
    props: ['data', 'customer_name', 'customer_email', "customer_id"],
    components: {
        Link
    },
    layout: AdminLayout,
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
        }
    },
}
</script>
