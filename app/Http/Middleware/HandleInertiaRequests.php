<?php

namespace App\Http\Middleware;

use App\Models\MenuItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     */
    public function share(Request $request): array
    {
        // Resolve navigation menus (DB first, config fallback)
        $primaryNav  = $this->resolveMenu('primary');
        $footerNav   = $this->resolveMenu('footer');

        // Site settings (DB + config fallback)
        $settings = $this->resolveSiteSettings();

        return array_merge(parent::share($request), [
            'site' => $settings,
            'nav'  => [
                'primary' => $primaryNav,
                'footer'  => $footerNav,
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error'   => fn () => $request->session()->get('error'),
            ],
        ]);
    }

    private function resolveMenu(string $location): array
    {
        try {
            $dbMenu = MenuItem::menuTree($location);
            if ($dbMenu->isNotEmpty()) {
                return $dbMenu->toArray();
            }
        } catch (\Exception $e) {
            // DB not ready yet
        }

        // Fallback to config
        $configKey = $location === 'primary' ? 'nav_primary' : 'nav_footer';
        return collect(config("jmsync.{$configKey}", []))->map(function ($item) {
            return [
                'label'       => $item['label'],
                'href'        => isset($item['route']) ? route($item['route']) : ($item['url'] ?? '#'),
                'open_new_tab'=> false,
                'css_class'   => null,
                'children'    => $item['children'] ?? [],
            ];
        })->toArray();
    }

    private function resolveSiteSettings(): array
    {
        $cfg = config('jmsync');

        try {
            $db = SiteSetting::all()->pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            $db = [];
        }

        return [
            'name'         => $db['site_name']    ?? $cfg['site_name'],
            'tagline'      => $db['site_tagline']  ?? $cfg['site_tagline'],
            'logo'         => $db['site_logo']     ?? $cfg['site_logo'],
            'logo_footer'  => $db['site_logo_footer'] ?? $cfg['site_logo_footer'],
            'header'       => [
                'style'        => $db['header_style']        ?? $cfg['header']['style'],
                'show_top_bar' => $db['header_show_top_bar'] ?? $cfg['header']['show_top_bar'],
                'top_info'     => $db['header_top_info']     ?? $cfg['header']['top_info'],
                'show_search'  => $db['header_show_search']  ?? $cfg['header']['show_search'],
            ],
            'footer'       => [
                'type'             => $db['footer_type']             ?? $cfg['footer']['type'],
                'tagline'          => $db['footer_tagline']          ?? $cfg['footer']['tagline'],
                'copyright'        => $db['footer_copyright']        ?? $cfg['footer']['copyright'],
                'address'          => $db['footer_address']          ?? $cfg['footer']['address'],
                'email'            => $db['footer_email']            ?? $cfg['footer']['email'],
                'phone'            => $db['footer_phone']            ?? $cfg['footer']['phone'],
                'show_newsletter'  => $db['footer_show_newsletter']  ?? $cfg['footer']['show_newsletter'],
            ],
            'social'       => [
                'facebook'  => $db['social_facebook']  ?? $cfg['social']['facebook'],
                'twitter'   => $db['social_twitter']   ?? $cfg['social']['twitter'],
                'linkedin'  => $db['social_linkedin']  ?? $cfg['social']['linkedin'],
                'instagram' => $db['social_instagram'] ?? $cfg['social']['instagram'],
                'youtube'   => $db['social_youtube']   ?? $cfg['social']['youtube'],
                'github'    => $db['social_github']    ?? $cfg['social']['github'],
            ],
            'analytics'    => [
                'google_id'    => $db['analytics_google_id']    ?? $cfg['analytics']['google_id'],
                'head_scripts' => $db['analytics_head_scripts'] ?? $cfg['analytics']['head_scripts'],
                'body_scripts' => $db['analytics_body_scripts'] ?? $cfg['analytics']['body_scripts'],
            ],
        ];
    }
}
