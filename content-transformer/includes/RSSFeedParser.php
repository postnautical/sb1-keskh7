<?php
class RSSFeedParser {
    public function fetch_feed($feed_url) {
        $rss = fetch_feed($feed_url);
        
        if (is_wp_error($rss)) {
            return array();
        }

        $max_items = $rss->get_item_quantity(5);
        $rss_items = $rss->get_items(0, $max_items);
        
        $items = array();
        foreach ($rss_items as $item) {
            $items[] = array(
                'title' => $item->get_title(),
                'content' => $item->get_content(),
                'description' => $item->get_description(),
                'link' => $item->get_permalink(),
                'date' => $item->get_date('U')
            );
        }
        
        return $items;
    }
}