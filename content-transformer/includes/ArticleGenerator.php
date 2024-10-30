<?php
class ArticleGenerator {
    private $openai;
    private $rss_parser;

    public function __construct() {
        $this->openai = new OpenAIClient();
        $this->rss_parser = new RSSFeedParser();
    }

    public function render($atts) {
        $atts = shortcode_atts(array(
            'feed_url' => '',
            'article_count' => 1
        ), $atts);

        if (empty($atts['feed_url'])) {
            return 'Please provide a feed URL';
        }

        $items = $this->rss_parser->fetch_feed($atts['feed_url']);
        if (empty($items)) {
            return 'No items found in feed';
        }

        $output = '';
        foreach (array_slice($items, 0, $atts['article_count']) as $item) {
            $prompt = "Create a 500-word engaging article based on the following content, maintaining a positive but balanced tone: " . $item['content'];
            $article = $this->openai->generate_content($prompt);
            
            if ($article) {
                $output .= sprintf(
                    '<article class="ai-generated-article"><h2>%s</h2><div class="article-content">%s</div></article>',
                    esc_html($item['title']),
                    wp_kses_post($article)
                );
            }
        }

        return $output;
    }
}