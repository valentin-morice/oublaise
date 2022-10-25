<template>
    <AdminBar>
        <Link as="button"
              class="px-4 py-2 text-white bg-orange-500 rounded" href="/logout" method="post">Logout
        </Link>
        <Link v-if="url()" class="px-4 py-2 text-white ml-2 bg-blue-500 rounded"
              href="/stripe">Dashboard
        </Link>
        <Link v-if="!url()" class="px-4 py-2 text-white ml-2 bg-blue-500 rounded"
              href="/">Home
        </Link>
    </AdminBar>
    <slot></slot>
    <footer class="footer footer-center p-4 bg-gray-300 text-base-content">
        <div>
            <p>Copyright © {{ new Date().getFullYear() }} - Domaine d'Oublaise, Fond de Dotation.</p>
        </div>
    </footer>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import AdminBar from "../Components/AdminBar";

export default {
    methods: {
        url() {
            return window.location.href == 'http://localhost/payment/create'
        },
        isDashboard() {
            if (window.location.href.includes('stripe/success')) return false;
            else if (window.location.href.includes('stripe')) return true;
        }
    },
    components: {
        Link,
        AdminBar
    }
}
</script>
