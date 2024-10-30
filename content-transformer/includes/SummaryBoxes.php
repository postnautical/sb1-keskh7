<?php
class SummaryBoxes {
    private $openai;
    private $rss_parser;

    public function __construct() {
        $this->openai = new OpenAIClient();
        $this->rss_parser = new RSSFeedParser();
    }

    public function render($atts) {
        $atts = shortcode_atts(array(
            'feed_url' => '',
            'box_count' => 3
        ), $atts);

        if (empty($atts['feed_url'])) {
            return 'Please provide a feed URL';
        }

        $items = $this->rss_parser->fetch_feed($atts['feed_url']);
        if (empty($items)) {
            return 'No items found in feed';
        }

        $output = '<div class="summary-boxes">';
        foreach (array_slice($items, 0, $atts['box_count']) as $item) {
            // Generate optimized headline
            $headline_prompt = "Rewrite this headline to be more engaging while maintaining the core message: " . $item['title'];
            $new_headline = $this->openai->generate_content($headline_prompt, 50);
            
            // Generate summary
            $summary_prompt = "Create a brief, engaging summary of this article in 50 words: " . $item['content'];
            $summary = $this->openai->generate_content($summary_prompt, 100);

            $output .= sprintf(
                '<div class="summary-box">
                    <h3>%s</h3>
                    <p>%s</p>
                    <a href="%s" class="read-more">Read More</a>
                </div>',
                esc_html($new_headline ?: $item['title']),
                wp_kses_post($summary),
                esc_url($item['link'])
            );
        }
        $output .= '</div>';

        return $output;
    }
}