import React, { useState } from 'react';
import ArticleView from './components/ArticleView';
import PodcastView from './components/PodcastView';
import SummaryBoxes from './components/SummaryBoxes';

// Simulated RSS feed data
const MOCK_RSS_FEED = [
  {
    title: "The Future of AI in Content Creation",
    content: "Artificial Intelligence is revolutionizing how we create and consume content. From automated writing assistants to intelligent content curation, AI is making it easier than ever to produce high-quality content at scale. However, the human touch remains essential in the creative process.",
    link: "#",
    date: new Date().toISOString()
  },
  {
    title: "Sustainable Technology Practices",
    content: "As technology continues to advance, the importance of sustainable practices becomes increasingly crucial. Companies are now focusing on green computing, energy-efficient data centers, and environmentally conscious product development.",
    link: "#",
    date: new Date().toISOString()
  },
  {
    title: "The Rise of Remote Work Culture",
    content: "Remote work has transformed from a temporary solution to a permanent fixture in modern business. Companies are adapting their processes, tools, and culture to support distributed teams while maintaining productivity and employee satisfaction.",
    link: "#",
    date: new Date().toISOString()
  }
];

function App() {
  const [activeTab, setActiveTab] = useState('articles');

  return (
    <div className="min-h-screen bg-gray-100 p-8">
      <div className="max-w-6xl mx-auto">
        <h1 className="text-4xl font-bold text-center mb-8">Content Transformer</h1>
        
        <div className="mb-8 flex justify-center space-x-4">
          <button 
            onClick={() => setActiveTab('articles')}
            className={\`px-4 py-2 rounded \${activeTab === 'articles' ? 'bg-blue-500 text-white' : 'bg-white'}\`}
          >
            Articles
          </button>
          <button 
            onClick={() => setActiveTab('podcast')}
            className={\`px-4 py-2 rounded \${activeTab === 'podcast' ? 'bg-blue-500 text-white' : 'bg-white'}\`}
          >
            Podcast
          </button>
          <button 
            onClick={() => setActiveTab('summary')}
            className={\`px-4 py-2 rounded \${activeTab === 'summary' ? 'bg-blue-500 text-white' : 'bg-white'}\`}
          >
            Summary Boxes
          </button>
        </div>

        <div className="bg-white rounded-lg shadow-lg p-6">
          {activeTab === 'articles' && <ArticleView articles={MOCK_RSS_FEED} />}
          {activeTab === 'podcast' && <PodcastView article={MOCK_RSS_FEED[0]} />}
          {activeTab === 'summary' && <SummaryBoxes articles={MOCK_RSS_FEED} />}
        </div>
      </div>
    </div>
  );
}

export default App;