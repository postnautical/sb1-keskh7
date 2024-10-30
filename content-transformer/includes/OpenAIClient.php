<?php
class OpenAIClient {
    private $api_key;
    private $api_endpoint = 'https://api.openai.com/v1/chat/completions';

    public function __construct() {
        $this->api_key = get_option('openai_api_key');
    }

    public function generate_content($prompt, $max_tokens = 1000) {
        $headers = array(
            'Authorization' => 'Bearer ' . $this->api_key,
            'Content-Type' => 'application/json',
        );

        $body = array(
            'model' => 'gpt-4',
            'messages' => array(
                array(
                    'role' => 'system',
                    'content' => 'You are a helpful assistant that creates engaging, positive, and balanced content.'
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => $max_tokens,
            'temperature' => 0.7
        );

        $response = wp_remote_post($this->api_endpoint, array(
            'headers' => $headers,
            'body' => json_encode($body),
            'timeout' => 30
        ));

        if (is_wp_error($response)) {
            return false;
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        return $body['choices'][0]['message']['content'] ?? false;
    }
}