<?php
/*
Plugin Name: Content Transformer
Description: Transforms RSS content into articles, podcasts, and summary boxes
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/ArticleGenerator.php';
require_once plugin_dir_path(__FILE__) . 'includes/PodcastGenerator.php';
require_once plugin_dir_path(__FILE__) . 'includes/SummaryBoxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/OpenAIClient.php';
require_once plugin_dir_path(__FILE__) . 'includes/RSSFeedParser.php';

class ContentTransformer {
    private $article_generator;
    private $podcast_generator;
    private $summary_boxes;

    public function __construct() {
        $this->article_generator = new ArticleGenerator();
        $this->podcast_generator = new PodcastGenerator();
        $this->summary_boxes = new SummaryBoxes();

        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_shortcode('ai_article', array($this->article_generator, 'render'));
        add_shortcode('ai_podcast', array($this->podcast_generator, 'render'));
        add_shortcode('summary_boxes', array($this->summary_boxes, 'render'));
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'content-transformer-styles',
            plugins_url('assets/css/styles.css', __FILE__)
        );
    }

    public function activate() {
        // Add activation tasks if needed
    }

    public function deactivate() {
        // Add deactivation tasks if needed
    }
}

$content_transformer = new ContentTransformer();
register_activation_hook(__FILE__, array($content_transformer, 'activate'));
register_deactivation_hook(__FILE__, array($content_transformer, 'deactivate'));