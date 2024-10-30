import React from 'react';

function PodcastView({ article }) {
  return (
    <div className="podcast-content prose max-w-none">
      <h2 className="text-2xl font-bold mb-4">{article.title} - Podcast Version</h2>
      <div className="bg-gray-50 p-6 rounded-lg mb-6">
        <p className="mb-4">
          {/* In a real app, this would be AI-generated podcast script */}
          Welcome to today's episode! Today we're diving deep into {article.title}.
        </p>
        <p className="mb-4">
          {article.content}
        </p>
        <p>
          This is a simulated podcast script. In the real application, this content 
          would be generated using the OpenAI API to create an engaging podcast script 
          based on the article content.
        </p>
      </div>
      <div className="audio-player bg-gray-100 p-4 rounded-lg">
        <p className="text-center text-gray-600">Audio version coming soon...</p>
      </div>
    </div>
  );
}