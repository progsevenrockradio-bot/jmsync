<script setup>
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import AppHeader from '@/Components/AppHeader.vue';
import AppFooter from '@/Components/AppFooter.vue';

const props = defineProps({
    title: {
        type: String,
        default: '',
    },
});

const page = usePage();
</script>

<template>
    <Head :title="title" />

    <!-- Scroll to top button -->
    <a href="javascript:void(0)" id="slide_top" class="cmsmasters_slide_top_icon">
        <span></span>
    </a>

    <!-- Start Page -->
    <div id="page" class="hfeed site">
        <!-- Start Main -->
        <div id="main">
            <!-- Header -->
            <header id="header">
                <AppHeader
                    :site="page.props.site"
                    :nav="page.props.nav"
                />
            </header>
            <!-- End Header -->

            <!-- Start Middle / Page Content -->
            <div id="middle">
                <slot />
            </div>
            <!-- End Middle -->
        </div>
        <!-- End Main -->

        <!-- Footer -->
        <footer id="footer">
            <AppFooter
                :site="page.props.site"
                :nav="page.props.nav"
            />
        </footer>
    </div>
    <!-- End Page -->
</template>
