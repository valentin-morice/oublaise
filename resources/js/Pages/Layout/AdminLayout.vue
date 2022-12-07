<template>
    <AdminBar>
        <Link class="px-2 py-1.5 text-white ml-2 bg-blue-600 rounded"
              href="/admin/payments">Payments
        </Link>
        <Link class="px-2 py-1.5 text-white ml-2 bg-blue-600 rounded"
              href="/admin/projects">Projects
        </Link>
        <Link class="px-2 py-1.5 text-white ml-2 bg-blue-600 rounded"
              href="/">Home
        </Link>
        <Link as="button"
              class="px-2 py-1 ml-2 text-white bg-red-600 rounded" href="/logout" method="post">Logout
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
    methods: {},
    components: {
        Link,
        AdminBar
    }
}
</script>
