<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@jmsync.es'],
            [
                'name' => 'Administrador JMSync',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Default Categories
        $catWeb = Category::updateOrCreate(['slug' => 'web-design'], ['name' => 'Diseño Web', 'type' => 'portfolio', 'order' => 1]);
        $catApp = Category::updateOrCreate(['slug' => 'app-design'], ['name' => 'Diseño App', 'type' => 'portfolio', 'order' => 2]);
        $catMarketing = Category::updateOrCreate(['slug' => 'marketing'], ['name' => 'Marketing', 'type' => 'blog', 'order' => 1]);
        $catDesign = Category::updateOrCreate(['slug' => 'design-trends'], ['name' => 'Tendencias de Diseño', 'type' => 'blog', 'order' => 2]);

        // 3. Default Site Settings
        $settings = [
            'site_name' => ['JMSync', 'text', 'general'],
            'site_tagline' => ['Trusted Design Partner', 'text', 'general'],
            'header_style' => ['default', 'text', 'header'],
            'header_show_top_bar' => ['1', 'boolean', 'header'],
            'header_top_info' => ['New York, NY 10013 &nbsp;|&nbsp; <a href="mailto:admin@jmsync.es">admin@jmsync.es</a>', 'text', 'header'],
            'footer_type' => ['default', 'text', 'footer'],
            'footer_tagline' => ['Somos una agencia creativa enfocada en ofrecer soluciones digitales óptimas y personalizadas bajo la marca jmsync.', 'text', 'footer'],
            'footer_copyright' => ['&copy; ' . date('Y') . ' JMSync. Todos los derechos reservados.', 'text', 'footer'],
            'footer_address' => ['Madrid, España', 'text', 'footer'],
            'footer_email' => ['admin@jmsync.es', 'text', 'footer'],
            'footer_phone' => ['+34 600 000 000', 'text', 'footer'],
            'social_facebook' => ['https://facebook.com', 'text', 'social'],
            'social_twitter' => ['https://twitter.com', 'text', 'social'],
            'social_linkedin' => ['https://linkedin.com', 'text', 'social'],
            'social_instagram' => ['https://instagram.com', 'text', 'social'],
        ];

        foreach ($settings as $key => $data) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $data[0], 'type' => $data[1], 'group' => $data[2]]
            );
        }

        // 4. Default Menu Items
        $menuPrimary = [
            ['label' => 'Inicio', 'route_name' => 'home', 'order' => 1],
            ['label' => 'Servicios', 'route_name' => 'services', 'order' => 2],
            ['label' => 'Portfolio', 'route_name' => 'portfolio.index', 'order' => 3],
            ['label' => 'Blog', 'route_name' => 'blog.index', 'order' => 4],
            ['label' => 'Contacto', 'route_name' => 'contact', 'order' => 5],
        ];

        foreach ($menuPrimary as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'menu_location' => 'primary'],
                ['route_name' => $item['route_name'], 'order' => $item['order']]
            );
        }

        $menuFooter = [
            ['label' => 'Servicios', 'route_name' => 'services', 'order' => 1],
            ['label' => 'Portfolio', 'route_name' => 'portfolio.index', 'order' => 2],
            ['label' => 'Blog', 'route_name' => 'blog.index', 'order' => 3],
            ['label' => 'Contacto', 'route_name' => 'contact', 'order' => 4],
        ];

        foreach ($menuFooter as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'menu_location' => 'footer'],
                ['route_name' => $item['route_name'], 'order' => $item['order']]
            );
        }

        // 5. Default Projects (Portfolio)
        Project::updateOrCreate(
            ['slug' => 'plataforma-web-jmsync'],
            [
                'title' => 'Plataforma Web JMSync',
                'excerpt' => 'Rediseño y desarrollo de la presencia digital corporativa con Laravel, Inertia y Vue.',
                'description' => 'Un proyecto completo enfocado en optimizar el rendimiento y la experiencia de usuario del sitio web original usando herramientas modernas.',
                'category_id' => $catWeb->id,
                'client' => 'JMSync Group',
                'project_url' => 'https://jmsync.es',
                'completed_at' => now(),
                'featured' => true,
                'published' => true,
                'order' => 1,
            ]
        );

        Project::updateOrCreate(
            ['slug' => 'aplicacion-movil-jmsync'],
            [
                'title' => 'Aplicación Móvil JMSync',
                'excerpt' => 'Diseño UI/UX interactivo de la aplicación móvil de servicios.',
                'description' => 'Estructura visual, prototipos interactivos y pruebas de usabilidad móvil para iOS y Android.',
                'category_id' => $catApp->id,
                'client' => 'JMSync Mobile',
                'project_url' => null,
                'completed_at' => now(),
                'featured' => true,
                'published' => true,
                'order' => 2,
            ]
        );

        // 6. Default Posts (Blog)
        Post::updateOrCreate(
            ['slug' => 'lanzamiento-nueva-web-laravel'],
            [
                'title' => 'Lanzamiento de la nueva web corporativa en Laravel',
                'excerpt' => 'Hoy presentamos oficialmente nuestra nueva plataforma de servicios de desarrollo.',
                'content' => 'Nos complace anunciar la migración completa de nuestra infraestructura web original a un moderno stack basado en Laravel 11, Inertia.js y Vue 3. Este cambio nos permite mejorar los tiempos de carga, potenciar la seguridad y ofrecer una plataforma robusta para todos nuestros clientes.',
                'category_id' => $catMarketing->id,
                'user_id' => $admin->id,
                'published' => true,
                'published_at' => now(),
                'reading_time' => 3,
                'tags' => ['laravel', 'vue', 'lanzamiento'],
            ]
        );
    }
}
