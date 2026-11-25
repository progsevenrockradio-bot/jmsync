import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import AppLayout from '@/Layouts/AppLayout.vue';

// Theme scripts (jQuery-based)
import $ from 'jquery';
window.jQuery = window.$ = $;

createInertiaApp({
    title: (title) => `${title} — JMSync`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        );
        page.then((module) => {
            // Use AppLayout as default layout if none is set
            module.default.layout = module.default.layout || AppLayout;
        });
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#4dd8e3',
    },
});

// ================================================
// Theme scripts initialization (after DOM ready)
// ================================================
document.addEventListener('DOMContentLoaded', () => {
    // Scroll-to-top button
    const slideTop = document.getElementById('slide_top');
    if (slideTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                slideTop.classList.add('visible');
            } else {
                slideTop.classList.remove('visible');
            }
        });
        slideTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Sticky header class on scroll
    const header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
