<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
    relatedPosts: Array,
});
</script>

<template>
    <Head :title="post.title" />

    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">{{ post.title }}</h1>
        </div>
    </div>

    <section class="blog-detail-section" style="padding: 80px 40px; max-width: 900px; margin: 0 auto;">
        
        <article>
            <!-- Meta -->
            <div style="display: flex; gap: 20px; font-size: 0.85rem; color: rgba(255,255,255,0.5); align-items: center; margin-bottom: 30px;">
                <span style="color: #4dd8e3; font-weight: 700; text-transform: uppercase;">{{ post.category }}</span>
                <span>•</span>
                <span>Por {{ post.author }}</span>
                <span>•</span>
                <span>{{ post.published_at }}</span>
                <span>•</span>
                <span>{{ post.reading_time }} min lectura</span>
            </div>

            <!-- Image -->
            <div style="aspect-ratio: 16/9; overflow: hidden; background: rgba(77,216,227,0.05); margin-bottom: 40px; border: 1px solid rgba(255,255,255,0.08);">
                <img
                    v-if="post.featured_image"
                    :src="post.featured_image"
                    :alt="post.title"
                    style="width: 100%; height: 100%; object-fit: cover;"
                />
            </div>

            <!-- Content -->
            <div
                class="post-content"
                style="font-size: 1.05rem; color: rgba(255,255,255,0.75); line-height: 1.8; margin-bottom: 60px;"
            >
                {{ post.content }}
            </div>

            <!-- Tags -->
            <div v-if="post.tags?.length" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 60px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 30px;">
                <span
                    v-for="tag in post.tags"
                    :key="tag"
                    style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; background: rgba(255,255,255,0.05); color: #fff; padding: 6px 14px; border-radius: 4px;"
                >
                    #{{ tag }}
                </span>
            </div>
        </article>

        <!-- Related Posts -->
        <div v-if="relatedPosts?.length" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 60px;">
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #fff; margin-bottom: 40px; text-transform: uppercase; letter-spacing: 0.05em;">
                Entradas <span class="text-outline">Relacionadas</span>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <div v-for="rel in relatedPosts" :key="rel.id" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); transition: var(--jmsync-transition);">
                    <Link :href="`/blog/${rel.slug}`" style="display: block;">
                        <div style="aspect-ratio: 16/9; overflow: hidden; background: rgba(77,216,227,0.05);">
                            <img
                                v-if="rel.featured_image"
                                :src="rel.featured_image"
                                :alt="rel.title"
                                style="width: 100%; height: 100%; object-fit: cover;"
                            />
                        </div>
                        <div style="padding: 16px;">
                            <h4 style="font-size: 0.9rem; font-weight: 700; color: #fff; margin-bottom: 8px; line-height: 1.3;">{{ rel.title }}</h4>
                            <span style="font-size: 0.75rem; color: rgba(255,255,255,0.4);">{{ rel.published_at }}</span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

    </section>
</template>
