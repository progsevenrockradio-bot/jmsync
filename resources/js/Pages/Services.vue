<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Servicios" />

    <!-- Header Headline -->
    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">Nuestros Servicios</h1>
        </div>
    </div>

    <section class="services-detail-section" style="padding: 100px 40px; max-width: 1200px; margin: 0 auto;">
        <div class="services-detail-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px;">
            
            <!-- Service 1 -->
            <div class="service-detail-card" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 40px; transition: var(--jmsync-transition);">
                <div style="font-size: 2rem; margin-bottom: 20px;">🎯</div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 16px;">Estrategia y Objetivos</h2>
                <p style="font-size: 0.9rem; color: rgba(255,255,255,0.6); line-height: 1.7;">
                    Analizamos las necesidades de tu negocio y definimos metas estratégicas claras. Estructuramos planes de marketing digital personalizados para maximizar el retorno de inversión y potenciar tu marca.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="service-detail-card" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 40px; transition: var(--jmsync-transition);">
                <div style="font-size: 2rem; margin-bottom: 20px;">🎨</div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 16px;">Diseño Visual y UX/UI</h2>
                <p style="font-size: 0.9rem; color: rgba(255,255,255,0.6); line-height: 1.7;">
                    Desarrollamos interfaces de usuario interactivas, atractivas y completamente responsivas que aseguran una experiencia de navegación óptima y retienen a tus clientes.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="service-detail-card" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 40px; transition: var(--jmsync-transition);">
                <div style="font-size: 2rem; margin-bottom: 20px;">💻</div>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 16px;">Desarrollo Web a Medida</h2>
                <p style="font-size: 0.9rem; color: rgba(255,255,255,0.6); line-height: 1.7;">
                    Construimos soluciones web robustas utilizando Laravel, Inertia y Vue, garantizando la velocidad, la seguridad y una arquitectura escalable para el futuro.
                </p>
            </div>

        </div>
    </section>
</template>
