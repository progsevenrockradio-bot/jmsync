<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    posts: Object,
    categories: Array,
});
</script>

<template>
    <Head title="Blog" />

    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">Noticias y Actualidad</h1>
        </div>
    </div>

    <section class="blog-list-section" style="padding: 80px 40px; max-width: 1200px; margin: 0 auto;">
        
        <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 60px;">
            
            <!-- Left: Posts List -->
            <div>
                <div v-if="!posts.data?.length" style="text-align: center; color: rgba(255,255,255,0.5); padding: 80px 0;">
                    No hay publicaciones disponibles en este momento.
                </div>
                <div v-else style="display: flex; flex-direction: column; gap: 60px;">
                    <article
                        v-for="post in posts.data"
                        :key="post.id"
                        style="border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 60px;"
                    >
                        <div style="aspect-ratio: 16/9; overflow: hidden; background: rgba(77,216,227,0.05); margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.08);">
                            <Link :href="`/blog/${post.slug}`" style="display: block; width: 100%; height: 100%;">
                                <img
                                    v-if="post.featured_image"
                                    :src="post.featured_image"
                                    :alt="post.title"
                                    style="width: 100%; height: 100%; object-fit: cover;"
                                />
                            </Link>
                        </div>
                        
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4dd8e3; letter-spacing: 0.05em; display: block; margin-bottom: 10px;">
                            {{ post.category }}
                        </span>
                        
                        <h2 style="font-size: 1.8rem; font-weight: 800; color: #fff; line-height: 1.3; margin: 0 0 16px;">
                            <Link :href="`/blog/${post.slug}`" style="color: #fff; transition: color 0.2s;">
                                {{ post.title }}
                            </Link>
                        </h2>

                        <p style="font-size: 0.95rem; color: rgba(255,255,255,0.6); line-height: 1.7; margin-bottom: 24px;">
                            {{ post.excerpt }}
                        </p>

                        <div style="display: flex; gap: 20px; font-size: 0.8rem; color: rgba(255,255,255,0.4); align-items: center; margin-bottom: 24px;">
                            <span>Por {{ post.author }}</span>
                            <span>•</span>
                            <span>{{ post.published_at }}</span>
                            <span>•</span>
                            <span>{{ post.reading_time }} min lectura</span>
                        </div>

                        <Link :href="`/blog/${post.slug}`" class="btn-jmsync btn-jmsync-accent">
                            Leer Más
                        </Link>
                    </article>
                </div>
            </div>

            <!-- Right: Sidebar -->
            <div>
                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 32px; margin-bottom: 30px;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 12px;">
                        Categorías
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                        <li v-for="cat in categories" :key="cat.slug">
                            <span style="font-size: 0.9rem; color: rgba(255,255,255,0.7);">
                                {{ cat.name }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </section>
</template>
