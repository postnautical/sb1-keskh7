import React from 'react';

function SummaryBoxes({ articles }) {
  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
      {articles.map((article, index) => (
        <div key={index} className="summary-box bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
          <h3 className="text-xl font-semibold mb-3">{article.title}</h3>
          <p className="text-gray-600 mb-4">
            {/* In a real app, this would be AI-generated summary */}
            {article.content.substring(0, 100)}...
          </p>
          <a href={article.link} className="text-blue-500 hover:text-blue-700 font-medium">
            Read More
          </a>
        </div>
      ))}
    </div>
  );
}