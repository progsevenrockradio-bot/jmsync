<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    projects: Array,
    categories: Array,
});

const activeCategory = ref('all');

const filteredProjects = computed(() => {
    if (activeCategory.value === 'all') {
        return props.projects;
    }
    return props.projects.filter(p => p.category_slug === activeCategory.value);
});
</script>

<template>
    <Head title="Portfolio" />

    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">Nuestro Portfolio</h1>
        </div>
    </div>

    <section class="portfolio-list-section" style="padding: 80px 40px; max-width: 1200px; margin: 0 auto;">
        
        <!-- Filter bar -->
        <div class="portfolio-filters" style="display: flex; gap: 16px; justify-content: center; margin-bottom: 48px; flex-wrap: wrap;">
            <button
                @click="activeCategory = 'all'"
                :style="activeCategory === 'all' ? 'background: #4dd8e3; color: #0d0e12; border-color: #4dd8e3;' : 'background: transparent; color: #fff; border-color: rgba(255,255,255,0.15);'"
                style="padding: 10px 24px; font-size: 0.8rem; font-weight: 700; border: 2px solid; text-transform: uppercase; cursor: pointer; transition: var(--jmsync-transition);"
            >
                Todos
            </button>
            <button
                v-for="cat in categories"
                :key="cat.slug"
                @click="activeCategory = cat.slug"
                :style="activeCategory === cat.slug ? 'background: #4dd8e3; color: #0d0e12; border-color: #4dd8e3;' : 'background: transparent; color: #fff; border-color: rgba(255,255,255,0.15);'"
                style="padding: 10px 24px; font-size: 0.8rem; font-weight: 700; border: 2px solid; text-transform: uppercase; cursor: pointer; transition: var(--jmsync-transition);"
            >
                {{ cat.name }}
            </button>
        </div>

        <!-- Project Grid -->
        <div class="portfolio-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 30px;">
            <div
                v-for="project in filteredProjects"
                :key="project.id"
                class="portfolio-card"
                style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); transition: var(--jmsync-transition); overflow: hidden;"
            >
                <Link :href="`/portfolio/${project.slug}`" style="display: block;">
                    <div style="aspect-ratio: 4/3; overflow: hidden; background: rgba(77,216,227,0.05);">
                        <img
                            v-if="project.featured_image"
                            :src="project.featured_image"
                            :alt="project.title"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                            onmouseover="this.style.transform='scale(1.05)'"
                            onmouseout="this.style.transform='scale(1)'"
                        />
                    </div>
                    <div style="padding: 24px;">
                        <span style="font-size: 0.7rem; font-weight: 700; color: #4dd8e3; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 8px;">
                            {{ project.category }}
                        </span>
                        <h2 style="font-size: 1.2rem; font-weight: 700; color: #fff; line-height: 1.4; margin: 0 0 12px;">
                            {{ project.title }}
                        </h2>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.55); line-height: 1.6; margin: 0;">
                            {{ project.excerpt }}
                        </p>
                    </div>
                </Link>
            </div>
        </div>

    </section>
</template>
