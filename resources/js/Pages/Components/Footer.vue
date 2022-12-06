<template>
    <footer class="footer p-10 md:py-20 bg-gray-700 text-base-content">
        <div class="mx-auto">
            <p class="text-gray-100 text-xl font-bold pt-4">Domaine d'Oublaise</p>
            <p class="text-gray-100">Un domaine d'exception, au coeur de l'Indre.</p>
        </div>
        <div class="text-gray-100">
            <span class="footer-title">Navigation</span>
            <Link class="link link-hover" href="/">Accueil</Link>
            <Link class="link link-hover" href="/history">Histoire</Link>
            <Link class="link link-hover" href="/payment/create">Donation</Link>
            <Link class="link link-hover" href="/login">Admin</Link>
        </div>
        <div class="text-gray-100">
            <span class="footer-title">Nos Services</span>
            <a class="link link-hover" href="https://newmayapur.com">New Mayapur</a>
            <a class="link link-hover" href="https://govindas.fr">Govinda's</a>
        </div>
        <div class="text-gray-100">
            <span class="footer-title">Legal</span>
            <a class="link link-hover">Politique de Confidentialité</a>
        </div>
    </footer>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    }
}
</script>
