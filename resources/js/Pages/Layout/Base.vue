<template>
    <NavBar>
        <li v-if="$page.props.isLogged">
            <Link href="/admin/payments">Admin</Link>
        </li>
        <template v-if="$page.props.isLogged" v-slot:responsive>
            <li>
                <Link href="/stripe">Admin</Link>
            </li>
        </template>
    </NavBar>
    <main>
        <slot/>
    </main>
    <Footer/>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import NavBar from "../Components/NavBar";
import Footer from "../Components/Footer";

export default {
    components: {
        Link,
        NavBar,
        Footer
    },
}
</script>

<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.7s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
