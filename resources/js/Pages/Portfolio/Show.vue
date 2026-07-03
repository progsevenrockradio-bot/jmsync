<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
    relatedProjects: Array,
});
</script>

<template>
    <Head :title="project.title" />

    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">{{ project.title }}</h1>
        </div>
    </div>

    <section class="project-detail-section" style="padding: 80px 40px; max-width: 1200px; margin: 0 auto;">
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 60px; margin-bottom: 80px;">
            
            <!-- Left: Image & Description -->
            <div>
                <div style="aspect-ratio: 16/9; background: rgba(77,216,227,0.05); margin-bottom: 40px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08);">
                    <img
                        v-if="project.featured_image"
                        :src="project.featured_image"
                        :alt="project.title"
                        style="width: 100%; height: 100%; object-fit: cover;"
                    />
                </div>
                <div style="font-size: 1rem; color: rgba(255,255,255,0.7); line-height: 1.8;">
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 20px;">Detalle del Proyecto</h2>
                    <p>{{ project.description }}</p>
                </div>
            </div>

            <!-- Right: Project Meta Card -->
            <div>
                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 32px;">
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #fff; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 16px;">
                        Información
                    </h3>
                    
                    <div style="margin-bottom: 20px;">
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4dd8e3; display: block; margin-bottom: 4px;">Categoría</span>
                        <span style="font-size: 0.95rem; color: #fff;">{{ project.category }}</span>
                    </div>

                    <div style="margin-bottom: 20px;" v-if="project.client">
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4dd8e3; display: block; margin-bottom: 4px;">Cliente</span>
                        <span style="font-size: 0.95rem; color: #fff;">{{ project.client }}</span>
                    </div>

                    <div style="margin-bottom: 20px;" v-if="project.completed_at">
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4dd8e3; display: block; margin-bottom: 4px;">Año</span>
                        <span style="font-size: 0.95rem; color: #fff;">{{ project.completed_at }}</span>
                    </div>

                    <div style="margin-top: 32px;" v-if="project.project_url">
                        <a
                            :href="project.project_url"
                            target="_blank"
                            class="btn-jmsync btn-jmsync-accent"
                            style="width: 100%; text-align: center;"
                        >
                            Visitar Sitio
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Related Projects -->
        <div v-if="relatedProjects?.length" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 60px;">
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #fff; margin-bottom: 40px; text-transform: uppercase; letter-spacing: 0.05em;">
                Proyectos <span class="text-outline">Relacionados</span>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <div v-for="rel in relatedProjects" :key="rel.id" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); transition: var(--jmsync-transition);">
                    <Link :href="`/portfolio/${rel.slug}`" style="display: block;">
                        <div style="aspect-ratio: 4/3; overflow: hidden; background: rgba(77,216,227,0.05);">
                            <img
                                v-if="rel.featured_image"
                                :src="rel.featured_image"
                                :alt="rel.title"
                                style="width: 100%; height: 100%; object-fit: cover;"
                            />
                        </div>
                        <div style="padding: 16px;">
                            <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin: 0;">{{ rel.title }}</h4>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

    </section>
</template>
