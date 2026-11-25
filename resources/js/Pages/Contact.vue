<script setup>
import { ref } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    website: '', // honeypot
});

const formSuccess = ref(false);

function submit() {
    form.post('/contacto', {
        onSuccess: () => {
            form.reset();
            formSuccess.value = true;
            setTimeout(() => {
                formSuccess.value = false;
            }, 6000);
        },
    });
}
</script>

<template>
    <Head title="Contacto" />

    <div class="cmsmasters_headline">
        <div class="cmsmasters_headline_inner">
            <h1 class="cmsmasters_headline_title">Contacto</h1>
        </div>
    </div>

    <section class="contact-section-detail" style="padding: 80px 40px; max-width: 1200px; margin: 0 auto;">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: start;">
            
            <!-- Left: Contact Info -->
            <div>
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #fff; line-height: 1.2; margin-bottom: 24px; text-transform: uppercase;">
                    ¿Tienes un proyecto en mente?<br />
                    <span class="text-outline">Hablemos</span>
                </h2>
                
                <p style="font-size: 0.95rem; color: rgba(255,255,255,0.6); line-height: 1.8; margin-bottom: 48px;">
                    Estamos aquí para ayudarte a transformar tus ideas en productos digitales de gran impacto. Ponte en contacto con nosotros hoy mismo y nuestro equipo te responderá lo antes posible.
                </p>

                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <span style="font-size: 1.5rem; color: #4dd8e3;">📍</span>
                        <div>
                            <strong style="color: #fff; display: block; font-size: 0.95rem; margin-bottom: 4px;">Ubicación</strong>
                            <span style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">{{ page.props.site?.footer?.address || 'Madrid, España' }}</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <span style="font-size: 1.5rem; color: #4dd8e3;">✉</span>
                        <div>
                            <strong style="color: #fff; display: block; font-size: 0.95rem; margin-bottom: 4px;">Email</strong>
                            <a :href="'mailto:' + (page.props.site?.footer?.email || 'admin@jmsync.es')" style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">
                                {{ page.props.site?.footer?.email || 'admin@jmsync.es' }}
                            </a>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px; align-items: flex-start;">
                        <span style="font-size: 1.5rem; color: #4dd8e3;">📞</span>
                        <div>
                            <strong style="color: #fff; display: block; font-size: 0.95rem; margin-bottom: 4px;">Teléfono</strong>
                            <a :href="'tel:' + (page.props.site?.footer?.phone || '+34600000000')" style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">
                                {{ page.props.site?.footer?.phone || '+34 600 000 000' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div>
                <div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); padding: 48px;">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 32px;">
                        Envíanos un Mensaje
                    </h3>

                    <!-- Success Alert -->
                    <div
                        v-if="formSuccess || page.props.flash?.success"
                        style="background: rgba(77,216,227,0.1); border: 1px solid #4dd8e3; color: #4dd8e3; padding: 16px; margin-bottom: 24px; font-size: 0.9rem;"
                    >
                        {{ page.props.flash?.success || '¡Mensaje enviado con éxito! Te responderemos muy pronto.' }}
                    </div>

                    <form @submit.prevent="submit" style="display: flex; flex-direction: column; gap: 20px;">
                        
                        <!-- Honeypot -->
                        <input v-model="form.website" type="text" style="display:none;" name="website" />

                        <div>
                            <input
                                v-model="form.name"
                                type="text"
                                placeholder="Nombre completo *"
                                required
                                style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.15); padding: 14px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s;"
                                onfocus="this.style.borderColor='#4dd8e3'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.15)'"
                            />
                            <span v-if="form.errors.name" style="color: #ff4500; font-size: 0.75rem; margin-top: 4px; display: block;">{{ form.errors.name }}</span>
                        </div>

                        <div>
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="Email *"
                                required
                                style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.15); padding: 14px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s;"
                                onfocus="this.style.borderColor='#4dd8e3'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.15)'"
                            />
                            <span v-if="form.errors.email" style="color: #ff4500; font-size: 0.75rem; margin-top: 4px; display: block;">{{ form.errors.email }}</span>
                        </div>

                        <div>
                            <input
                                v-model="form.phone"
                                type="text"
                                placeholder="Teléfono"
                                style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.15); padding: 14px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s;"
                                onfocus="this.style.borderColor='#4dd8e3'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.15)'"
                            />
                        </div>

                        <div>
                            <input
                                v-model="form.subject"
                                type="text"
                                placeholder="Asunto"
                                style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.15); padding: 14px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s;"
                                onfocus="this.style.borderColor='#4dd8e3'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.15)'"
                            />
                        </div>

                        <div>
                            <textarea
                                v-model="form.message"
                                placeholder="Mensaje *"
                                required
                                rows="5"
                                style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.15); padding: 14px; color: #fff; font-size: 0.9rem; outline: none; transition: border-color 0.2s; resize: vertical;"
                                onfocus="this.style.borderColor='#4dd8e3'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.15)'"
                            ></textarea>
                            <span v-if="form.errors.message" style="color: #ff4500; font-size: 0.75rem; margin-top: 4px; display: block;">{{ form.errors.message }}</span>
                        </div>

                        <button
                            type="submit"
                            class="btn-jmsync btn-jmsync-accent"
                            style="width: 100%; cursor: pointer;"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? 'Enviando...' : 'Enviar Mensaje' }}
                        </button>

                    </form>
                </div>
            </div>

        </div>

    </section>
</template>
