<template>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
                <label class="btn btn-ghost lg:hidden" tabindex="0">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h8m-8 6h16" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"/>
                    </svg>
                </label>
                <ul class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
                    tabindex="0">
                    <li>
                        <Link href="/">Home</Link>
                    </li>
                    <li>
                        <Link href="/payment/create">Donation</Link>
                    </li>
                    <li>
                        <Link href="/history">Histoire</Link>
                    </li>
                    <slot name="responsive"></slot>
                </ul>
            </div>
            <Link href="/">
                <p class="btn btn-ghost normal-case text-xl">LOGO</p>
            </Link>
        </div>
        <div class="navbar-end hidden lg:flex">
            <ul class="menu menu-horizontal space-x-1 p-0">
                <li>
                    <Link href="/">Home</Link>
                </li>
                <li>
                    <Link href="/payment/create">Donation</Link>
                </li>
                <li>
                    <Link href="/history">Histoire</Link>
                </li>
                <slot></slot>
            </ul>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    }
}
</script>
