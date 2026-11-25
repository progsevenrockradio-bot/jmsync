<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    featuredProjects: Array,
    latestPosts: Array,
});

// Animated hero words
const heroWords = ['trusted', 'trusted'];
</script>

<template>
    <Head title="Inicio" />

    <!-- ====================== HERO SECTION ====================== -->
    <section class="hero-section">
        <div class="hero-inner">
            <!-- Left: Heading + CTA -->
            <div class="hero-left">
                <h1 class="hero-heading">
                    <span class="hero-word-1">trusted</span>
                    <span class="hero-word-2">design</span>
                    <span class="hero-word-3">partner</span>
                </h1>
                <Link href="/contacto" class="btn-jmsync hero-cta">
                    RESERVA UNA CONSULTA GRATUITA
                </Link>
            </div>

            <!-- Center: 3D Object visual -->
            <div class="hero-center">
                <div class="hero-blob-wrap">
                    <div class="hero-blob"></div>
                </div>
                <p class="hero-desc">
                    Somos una agencia creativa que ofrece una amplia gama de servicios para ayudar a empresas y organizaciones con sus necesidades creativas y de marketing.
                </p>
            </div>

            <!-- Right: Rating card -->
            <div class="hero-right">
                <div class="hero-rating">
                    <span class="hero-rating-platform">fiverr. ⭐ 5.0</span>
                    <div class="hero-rating-card">
                        <strong>Cliente Satisfecho</strong>
                        <p>Una agencia creativa que proporciona una amplia gama de servicios para ayudar a empresas y organizaciones.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================== CLIENTS STRIP ====================== -->
    <section class="clients-section">
        <div class="clients-inner">
            <div class="clients-track">
                <span class="client-logo">Vanalaya</span>
                <span class="client-logo">FastCompany</span>
                <span class="client-logo">Marketo</span>
                <span class="client-logo">Folgers.</span>
                <span class="client-logo">XBOX</span>
                <span class="client-logo">Vanalaya</span>
                <span class="client-logo">FastCompany</span>
                <span class="client-logo">Marketo</span>
            </div>
        </div>
    </section>

    <!-- ====================== ABOUT / POWER SECTION ====================== -->
    <section class="power-section">
        <div class="power-inner">
            <div class="power-heading-wrap">
                <h2 class="power-heading">
                    Experimenta el poder del<br />
                    marketing digital con <span class="text-outline">JMSYNC</span>
                </h2>
            </div>
            <div class="power-content">
                <p class="power-desc">
                    Somos una agencia creativa que proporciona una amplia gama de servicios para ayudar a empresas y organizaciones con sus necesidades creativas y de marketing. Las agencias creativas a menudo emplean un equipo de expertos en varios campos creativos, como diseño, publicidad, redacción, desarrollo web, marketing en redes sociales y branding.
                </p>
                <Link href="/servicios" class="btn-jmsync">
                    MÁS SOBRE NOSOTROS
                </Link>
            </div>
        </div>
        <!-- Animated wave -->
        <div class="power-wave">
            <svg viewBox="0 0 1440 200" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,100 C360,0 720,200 1080,100 C1260,50 1380,120 1440,100 L1440,200 L0,200 Z"
                      fill="none" stroke="rgba(77,216,227,0.3)" stroke-width="1.5"/>
                <path d="M0,120 C400,20 800,220 1200,100 C1320,60 1400,130 1440,110"
                      fill="none" stroke="rgba(201,162,39,0.2)" stroke-width="1"/>
            </svg>
        </div>
    </section>

    <!-- ====================== SERVICES SECTION ====================== -->
    <section class="services-section">
        <div class="services-inner">
            <div class="services-header">
                <div>
                    <h2 class="section-heading">
                        Explora Nuestra Gama de<br />
                        <span class="text-outline">SERVICIOS</span>
                    </h2>
                </div>
                <Link href="/servicios" class="btn-jmsync">
                    TODOS LOS SERVICIOS
                </Link>
            </div>

            <!-- Service items (numbered) -->
            <div class="service-list">
                <div class="service-item">
                    <div class="service-left">
                        <span class="section-number">01 —</span>
                        <h3 class="service-title">
                            Definición de <span class="text-outline-gold">OBJETIVOS</span>
                        </h3>
                        <p class="service-desc">
                            Trabajamos contigo para definir objetivos claros y estrategias efectivas que impulsen el crecimiento de tu negocio.
                        </p>
                    </div>
                    <div class="service-right">
                        <div class="service-visual service-visual--gold"></div>
                    </div>
                </div>

                <div class="service-item service-item--reverse">
                    <div class="service-left">
                        <span class="section-number">02 —</span>
                        <h3 class="service-title">
                            Visual y <span class="text-outline">CONTENIDO</span>
                        </h3>
                        <p class="service-desc">
                            Creamos identidades visuales impactantes y contenido que conecta con tu audiencia y refleja los valores de tu marca.
                        </p>
                    </div>
                    <div class="service-right">
                        <div class="service-visual service-visual--cyan"></div>
                    </div>
                </div>

                <div class="service-item">
                    <div class="service-left">
                        <span class="section-number">03 —</span>
                        <h3 class="service-title">
                            Testing y <span class="text-outline-gold">LANZAMIENTO</span>
                        </h3>
                        <p class="service-desc">
                            Garantizamos que cada proyecto sea probado exhaustivamente antes del lanzamiento para asegurar una experiencia perfecta.
                        </p>
                    </div>
                    <div class="service-right">
                        <div class="service-visual service-visual--blue"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================== PORTFOLIO SECTION ====================== -->
    <section class="portfolio-section" v-if="featuredProjects?.length">
        <div class="portfolio-inner">
            <div class="portfolio-header">
                <h2 class="section-heading">
                    Nuestro <span class="text-outline">PORTFOLIO</span>
                </h2>
                <Link href="/portfolio" class="btn-jmsync">VER TODO</Link>
            </div>

            <div class="portfolio-grid">
                <div
                    v-for="project in featuredProjects"
                    :key="project.id"
                    class="portfolio-card"
                >
                    <Link :href="`/portfolio/${project.slug}`" class="portfolio-card-link">
                        <div class="portfolio-card-img-wrap">
                            <img
                                v-if="project.featured_image"
                                :src="project.featured_image"
                                :alt="project.title"
                                class="portfolio-card-img"
                            />
                            <div v-else class="portfolio-card-placeholder"></div>
                        </div>
                        <div class="portfolio-card-body">
                            <span class="portfolio-card-category">{{ project.category }}</span>
                            <h3 class="portfolio-card-title">{{ project.title }}</h3>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================== BLOG SECTION ====================== -->
    <section class="blog-section" v-if="latestPosts?.length">
        <div class="blog-inner">
            <div class="blog-header">
                <h2 class="section-heading">
                    Últimas <span class="text-outline">NOTICIAS</span>
                </h2>
                <Link href="/blog" class="btn-jmsync">VER BLOG</Link>
            </div>

            <div class="blog-grid">
                <div
                    v-for="post in latestPosts"
                    :key="post.id"
                    class="blog-card"
                >
                    <Link :href="`/blog/${post.slug}`" class="blog-card-link">
                        <div class="blog-card-img-wrap">
                            <img
                                v-if="post.featured_image"
                                :src="post.featured_image"
                                :alt="post.title"
                                class="blog-card-img"
                            />
                            <div v-else class="blog-card-placeholder"></div>
                        </div>
                        <div class="blog-card-body">
                            <span class="blog-card-category">{{ post.category }}</span>
                            <h3 class="blog-card-title">{{ post.title }}</h3>
                            <p class="blog-card-excerpt">{{ post.excerpt }}</p>
                            <div class="blog-card-meta">
                                <span>{{ post.published_at }}</span>
                                <span>{{ post.reading_time }} min lectura</span>
                            </div>
                            <span class="btn-jmsync btn-jmsync-accent" style="font-size:0.7rem;padding:8px 20px;margin-top:16px;display:inline-block;">
                                LEER MÁS
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================== CONTACT CTA ====================== -->
    <section class="cta-section">
        <div class="cta-inner">
            <h2 class="section-heading">
                ¿Listo para comenzar<br />
                tu <span class="text-outline">PROYECTO</span>?
            </h2>
            <p class="cta-desc">Cuéntanos tu idea y la convertimos en realidad.</p>
            <Link href="/contacto" class="btn-jmsync btn-jmsync-accent" style="font-size:0.85rem;padding:16px 48px;">
                CONTÁCTANOS
            </Link>
        </div>
    </section>

</template>

<style scoped>
/* ===== HERO ===== */
.hero-section {
    min-height: 100vh;
    background: var(--jmsync-bg);
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hero-inner {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 40px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 120px 40px 80px;
    align-items: center;
    width: 100%;
}

.hero-heading {
    font-size: clamp(3rem, 6vw, 5.5rem);
    font-weight: 900;
    line-height: 1.0;
    color: #fff;
    display: flex;
    flex-direction: column;
}

.hero-word-2,
.hero-word-3 {
    display: block;
}

.hero-cta {
    display: inline-block;
    margin-top: 40px;
    font-size: 0.7rem;
    letter-spacing: 0.12em;
}

.hero-blob-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 24px;
}

.hero-blob {
    width: 360px;
    height: 360px;
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    background: radial-gradient(circle at 30% 30%, #4dd8e3, #0d5ba3, #c9a227, #ff4500);
    animation: morphBlob 8s ease-in-out infinite;
    box-shadow: 0 0 80px rgba(77,216,227,0.3);
}

@keyframes morphBlob {
    0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    25%  { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
    50%  { border-radius: 50% 50% 40% 60% / 30% 70% 60% 40%; }
    75%  { border-radius: 40% 60% 60% 40% / 70% 40% 60% 30%; }
}

.hero-desc {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.7);
    line-height: 1.7;
    text-align: center;
    max-width: 320px;
    margin: 0 auto;
}

.hero-rating {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.hero-rating-platform {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.7);
}

.hero-rating-card {
    border: 1px solid rgba(255,255,255,0.15);
    padding: 20px;
    background: rgba(255,255,255,0.03);
}

.hero-rating-card strong {
    display: block;
    margin-bottom: 8px;
    font-size: 0.95rem;
    color: #fff;
}

.hero-rating-card p {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
    line-height: 1.6;
}

/* ===== CLIENTS ===== */
.clients-section {
    background: var(--jmsync-bg-2);
    padding: 48px 0;
    overflow: hidden;
}

.clients-inner { overflow: hidden; }

.clients-track {
    display: flex;
    gap: 80px;
    animation: scrollClients 20s linear infinite;
    white-space: nowrap;
}

@keyframes scrollClients {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.client-logo {
    font-size: 1.1rem;
    font-weight: 700;
    color: rgba(255,255,255,0.4);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    transition: color 0.3s;
    flex-shrink: 0;
}

.client-logo:hover { color: rgba(255,255,255,0.8); }

/* ===== POWER/ABOUT ===== */
.power-section {
    background: var(--jmsync-bg);
    padding: 120px 40px;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}

.power-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}

.power-heading {
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 800;
    line-height: 1.15;
    color: #fff;
    margin-bottom: 0;
}

.power-desc {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.65);
    line-height: 1.8;
    margin-bottom: 32px;
}

.power-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 200px;
    opacity: 0.6;
}

.power-wave svg { width: 100%; height: 100%; }

/* ===== SERVICES ===== */
.services-section {
    background: var(--jmsync-bg-2);
    padding: 120px 40px;
}

.services-inner { max-width: 1400px; margin: 0 auto; }

.services-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 80px;
}

.service-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.service-item {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    padding: 80px 0;
    border-top: 1px solid rgba(255,255,255,0.06);
    align-items: center;
}

.service-item--reverse { direction: rtl; }
.service-item--reverse .service-left { direction: ltr; }
.service-item--reverse .service-right { direction: ltr; }

.service-title {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    line-height: 1.1;
    color: #fff;
    margin: 12px 0 20px;
}

.service-desc {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.6);
    line-height: 1.8;
}

.service-visual {
    width: 100%;
    aspect-ratio: 4/3;
    border-radius: 8px;
    background: rgba(77,216,227,0.05);
    border: 1px solid rgba(77,216,227,0.1);
}

.service-visual--gold { border-color: rgba(201,162,39,0.2); background: rgba(201,162,39,0.03); }
.service-visual--blue { border-color: rgba(0,100,255,0.2); background: rgba(0,100,255,0.03); }

/* ===== PORTFOLIO ===== */
.portfolio-section {
    background: var(--jmsync-bg);
    padding: 120px 40px;
}

.portfolio-inner { max-width: 1400px; margin: 0 auto; }

.portfolio-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 60px;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.portfolio-card {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.06);
    transition: all 0.3s ease;
    overflow: hidden;
}

.portfolio-card:hover {
    border-color: rgba(77,216,227,0.3);
    transform: translateY(-4px);
}

.portfolio-card-link { display: block; }

.portfolio-card-img-wrap {
    aspect-ratio: 4/3;
    overflow: hidden;
}

.portfolio-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.portfolio-card:hover .portfolio-card-img { transform: scale(1.05); }

.portfolio-card-placeholder {
    width: 100%;
    height: 100%;
    background: rgba(77,216,227,0.05);
}

.portfolio-card-body {
    padding: 20px;
}

.portfolio-card-category {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--jmsync-accent);
    display: block;
    margin-bottom: 8px;
}

.portfolio-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.4;
}

/* ===== BLOG ===== */
.blog-section {
    background: var(--jmsync-bg-2);
    padding: 120px 40px;
}

.blog-inner { max-width: 1400px; margin: 0 auto; }

.blog-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 60px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.blog-card {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.06);
    transition: all 0.3s ease;
    overflow: hidden;
}

.blog-card:hover {
    border-color: rgba(77,216,227,0.3);
    transform: translateY(-4px);
}

.blog-card-link { display: block; }

.blog-card-img-wrap {
    aspect-ratio: 16/9;
    overflow: hidden;
}

.blog-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card:hover .blog-card-img { transform: scale(1.05); }

.blog-card-placeholder {
    width: 100%;
    height: 100%;
    background: rgba(77,216,227,0.05);
    min-height: 180px;
}

.blog-card-body { padding: 24px; }

.blog-card-category {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--jmsync-accent);
    display: block;
    margin-bottom: 10px;
}

.blog-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.4;
    margin-bottom: 12px;
}

.blog-card-excerpt {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.55);
    line-height: 1.7;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-meta {
    display: flex;
    gap: 16px;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
}

/* ===== CTA ===== */
.cta-section {
    background: var(--jmsync-bg);
    padding: 120px 40px;
    text-align: center;
}

.cta-inner { max-width: 800px; margin: 0 auto; }

.cta-desc {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.6);
    margin: 24px 0 40px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .hero-inner {
        grid-template-columns: 1fr 1fr;
    }
    .hero-right { display: none; }
    .portfolio-grid,
    .blog-grid { grid-template-columns: repeat(2, 1fr); }
    .service-item { grid-template-columns: 1fr; gap: 40px; }
    .service-item--reverse { direction: ltr; }
    .power-inner { grid-template-columns: 1fr; gap: 40px; }
}

@media (max-width: 768px) {
    .hero-inner {
        grid-template-columns: 1fr;
        padding: 100px 24px 60px;
    }
    .hero-center { order: -1; }
    .hero-heading { font-size: 3rem; }
    .hero-blob { width: 240px; height: 240px; }
    .portfolio-grid,
    .blog-grid { grid-template-columns: 1fr; }
    .services-header,
    .portfolio-header,
    .blog-header { flex-direction: column; gap: 20px; }
    .power-section,
    .services-section,
    .portfolio-section,
    .blog-section,
    .cta-section { padding: 80px 24px; }
}
</style>
