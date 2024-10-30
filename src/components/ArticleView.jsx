import React from 'react';

function ArticleView({ articles }) {
  return (
    <div className="space-y-8">
      {articles.map((article, index) => (
        <article key={index} className="prose max-w-none">
          <h2 className="text-2xl font-bold mb-4">{article.title}</h2>
          <div className="text-gray-700">
            {/* In a real app, this would be AI-generated content */}
            <p className="mb-4">
              {article.content}
            </p>
            <p className="mb-4">
              This is a simulated AI-generated expansion of the article. In the real application, 
              this content would be generated using the OpenAI API to create a comprehensive, 
              engaging 500-word article based on the RSS feed content.
            </p>
          </div>
        </article>
      ))}
    </div>
  );
}