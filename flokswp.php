<?php
/**
 * Plugin Name: FloksWP
 * Description: Concrete reusable Elementor elements built on FrnlWP.
 * Version: 0.2.0
 */
defined('ABSPATH')||exit;
require_once __DIR__.'/vendor/autoload.php';
(new FloksWP\Plugin())->register();
