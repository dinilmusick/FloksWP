<?php
namespace FloksWP;

use FloksWP\Widget\Button;
use FloksWP\Widget\Panel;

final class Plugin {
    public function register(): void {
        if (!class_exists('Elementor\\Plugin')) return;
        add_action('elementor/widgets/register',static function($manager): void {
            $manager->register(new Button());
            $manager->register(new Panel());
        });
        add_action('wp_enqueue_scripts',static function(): void {
            wp_enqueue_style('flokswp',plugins_url('../assets/flokswp.css',__FILE__),[],Plugin::VERSION);
        });
    }
    public const VERSION='0.2.0';
}