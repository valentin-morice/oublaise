<template>
    <div class="bg-base-200 py-16 min-h-screen">
        <div class="bg-white md:w-2/3 mx-1 md:mx-auto p-4 rounded-xl shadow-lg">
            <div class="flex flex-col md:flex-row justify-between md:pl-2">
                <div class="flex">
                    <h1 class="font-bold text-xl text-gray-700">All Payments</h1>
                </div>
                <input
                    v-model="search"
                    class="mt-4 md:mt-0 shadow appearance-none border rounded h-9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Search for customers..."
                    type="text">
            </div>
            <div class="overflow-x-auto relative mt-6">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="py-3 px-6" scope="col">
                            Customer name
                        </th>
                        <th class="py-3 px-6" scope="col">
                            Date
                        </th>
                        <th class="py-3 px-6" scope="col">
                            Email
                        </th>
                        <th class="py-3 px-6" scope="col">
                            Amount
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in data.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                            <Link :href="'/stripe/' + payment.customer_id" preserve-scroll>{{ payment.name }}</Link>
                        </th>
                        <td class="py-4 px-6">
                            {{ payment.date }}
                        </td>
                        <td class="py-4 px-6">
                            {{ payment.email }}
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
                :href="'/stripe' + link.url"
                class="py-2 px-3 rounded bg-white m-1 shadow-lg"
                preserve-scroll
                v-html="link.label"
            />
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";
import {Link} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash";
import AdminLayout from "./Layout/AdminLayout";

export default {
    props: ['data', 'searchQuery'],
    components: {
        Link,
    },
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
    data() {
        return {
            search: this.searchQuery,
        }
    },
    watch: {
        search: debounce(function (value) {
            Inertia.get('/stripe', {
                search: value,
            }, {
                preserveState: true,
                replace: true,
                preserveScroll: true,
            })
        }, 500)
    },
    layout: AdminLayout
}
</script>
