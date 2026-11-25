<script setup>
import { ref } from 'vue';

const props = defineProps({
    site: Object,
    nav: Object,
});

const email = ref('');

function subscribe() {
    // Newsletter subscription - placeholder
    if (email.value) {
        email.value = '';
        alert('¡Gracias por suscribirte!');
    }
}
</script>

<template>
    <div class="footer cmsmasters_color_scheme_footer cmsmasters_footer_default">
        <div class="footer_inner">

            <!-- Footer Grid -->
            <div class="footer_grid">

                <!-- Col 1: Logo + Tagline -->
                <div class="footer_col">
                    <a href="/" class="footer_logo">
                        <template v-if="site?.logo_footer">
                            <img :src="site.logo_footer" :alt="site?.name" style="height:36px;width:auto;" />
                        </template>
                        <template v-else>
                            {{ site?.name || 'JMSync' }}
                        </template>
                    </a>
                    <p class="footer_tagline">
                        {{ site?.footer?.tagline }}
                    </p>
                </div>

                <!-- Col 2: Information (nav) -->
                <div class="footer_col">
                    <h3 class="footer_col_title">Información</h3>
                    <ul class="footer_nav_list footer_nav">
                        <li v-for="item in nav?.footer" :key="item.label">
                            <a :href="item.href">{{ item.label }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Contact Info -->
                <div class="footer_col">
                    <h3 class="footer_col_title">Información de Contacto</h3>
                    <div class="footer_contact_item" v-if="site?.footer?.address">
                        <span class="footer_contact_icon">📍</span>
                        <span>{{ site.footer.address }}</span>
                    </div>
                    <div class="footer_contact_item" v-if="site?.footer?.email">
                        <span class="footer_contact_icon">✉</span>
                        <a :href="'mailto:' + site.footer.email">{{ site.footer.email }}</a>
                    </div>
                    <div class="footer_contact_item" v-if="site?.footer?.phone">
                        <span class="footer_contact_icon">📞</span>
                        <a :href="'tel:' + site.footer.phone">{{ site.footer.phone }}</a>
                    </div>
                </div>

                <!-- Col 4: Newsletter -->
                <div class="footer_col" v-if="site?.footer?.show_newsletter !== false">
                    <h3 class="footer_newsletter_title">Suscríbete a Nuestro</h3>
                    <p class="footer_newsletter_subtitle">NEWSLETTER</p>
                    <form class="footer_newsletter_form" @submit.prevent="subscribe">
                        <input
                            v-model="email"
                            type="email"
                            class="footer_newsletter_input"
                            placeholder="Email"
                            required
                        />
                        <button type="submit" class="footer_newsletter_btn">
                            Suscribirse
                        </button>
                    </form>
                </div>

            </div>

            <!-- Copyright bar -->
            <div class="footer_copyright copyright">
                <span v-html="site?.footer?.copyright || '&copy; ' + new Date().getFullYear() + ' JMSync. Todos los derechos reservados.'" />
            </div>

        </div>
    </div>
</template>
