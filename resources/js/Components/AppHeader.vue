<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    site: Object,
    nav: Object,
});

const mobileOpen = ref(false);
const scrolled = ref(false);
const page = usePage();

function handleScroll() {
    scrolled.value = window.scrollY > 50;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

function isActive(href) {
    return window.location.pathname === new URL(href, window.location.origin).pathname;
}
</script>

<template>
    <div :class="['header_mid', { scrolled }]" style="position:relative;">
        <div class="header_mid_outer">
            <div class="header_mid_inner" style="display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:80px;">

                <!-- Logo -->
                <div class="logo_wrap">
                    <Link href="/" class="site-logo">
                        <template v-if="site?.logo">
                            <img :src="site.logo" :alt="site.name" style="height:40px;width:auto;" />
                        </template>
                        <template v-else>
                            <span style="font-size:1.5rem;font-weight:900;letter-spacing:0.05em;text-transform:uppercase;color:#fff;">
                                {{ site?.name || 'JMSync' }}
                            </span>
                        </template>
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="mid_nav_wrap" style="display:flex;align-items:center;gap:8px;">
                    <nav>
                        <ul class="mid_nav navigation" style="display:flex;list-style:none;gap:36px;margin:0;padding:0;">
                            <li
                                v-for="item in nav?.primary"
                                :key="item.label"
                                :class="{ 'current-menu-item': isActive(item.href) }"
                                class="menu-item"
                            >
                                <a
                                    :href="item.href"
                                    :target="item.open_new_tab ? '_blank' : '_self'"
                                    :class="item.css_class"
                                >
                                    <span class="nav_item_wrap">{{ item.label }}</span>
                                </a>

                                <!-- Dropdown -->
                                <ul v-if="item.children?.length" class="sub-menu">
                                    <li v-for="child in item.children" :key="child.label">
                                        <a :href="child.href">{{ child.label }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Mobile burger button -->
                <button
                    class="responsive_nav resp_mid_nav cmsmasters_theme_icon_resp_nav"
                    style="display:none;background:none;border:none;cursor:pointer;padding:8px;"
                    @click="mobileOpen = !mobileOpen"
                    aria-label="Menu"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile nav overlay -->
        <transition name="slide-down">
            <div
                v-if="mobileOpen"
                style="background:rgba(13,14,18,0.98);padding:20px 24px;border-top:1px solid rgba(255,255,255,0.08);"
            >
                <nav>
                    <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px;">
                        <li v-for="item in nav?.primary" :key="item.label">
                            <a
                                :href="item.href"
                                style="display:block;padding:12px 0;font-size:1rem;font-weight:500;color:#fff;border-bottom:1px solid rgba(255,255,255,0.05);"
                                @click="mobileOpen = false"
                            >{{ item.label }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </transition>
    </div>
</template>

<style scoped>
/* Desktop nav hidden on mobile */
@media (max-width: 768px) {
    .mid_nav_wrap {
        display: none !important;
    }
    .responsive_nav {
        display: block !important;
    }
}

.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.3s ease;
}
.slide-down-enter-from,
.slide-down-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Dropdown */
.menu-item {
    position: relative;
}
.menu-item .sub-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 200px;
    background: rgba(13,14,18,0.97);
    border: 1px solid rgba(255,255,255,0.08);
    list-style: none;
    padding: 8px 0;
    z-index: 100;
}
.menu-item:hover .sub-menu {
    display: block;
}
.menu-item .sub-menu li a {
    display: block;
    padding: 10px 20px;
    font-size: 0.875rem;
    color: rgba(255,255,255,0.8);
    white-space: nowrap;
    transition: color 0.2s, background 0.2s;
}
.menu-item .sub-menu li a:hover {
    color: #4dd8e3;
    background: rgba(77,216,227,0.05);
}
</style>
