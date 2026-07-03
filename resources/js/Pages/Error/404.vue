<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Página no encontrada" />

    <section style="display: flex; align-items: center; justify-content: center; min-height: 70vh; text-align: center; padding: 40px 24px;">
        <div>
            <span class="text-outline-gold" style="font-size: clamp(6rem, 12vw, 10rem); font-weight: 900; line-height: 1; display: block; margin-bottom: 20px;">
                404
            </span>
            <h1 style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 16px; text-transform: uppercase;">
                Página no encontrada
            </h1>
            <p style="font-size: 1rem; color: rgba(255,255,255,0.6); max-width: 480px; margin: 0 auto 40px; line-height: 1.6;">
                Lo sentimos, el enlace que has seguido puede estar roto o la página puede haber sido eliminada de la plataforma jmsync.
            </p>
            <Link href="/" class="btn-jmsync btn-jmsync-accent">
                Volver al Inicio
            </Link>
        </div>
    </section>
</template>
