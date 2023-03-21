import { getAllTopics } from './all-topics.js';


const urlParams = new URLSearchParams(window.location.search);
const topic = urlParams.get('topic');

document.getElementById('topic').value = topic;

document.getElementById('create-post-form').addEventListener('submit', (e) => {
    e.preventDefault();

    // Handle the form submission here (e.g., send a request to your server to create the post)

    alert('Post created!'); // Remove this line when implementing server-side logic
    window.location.href = `topic.html?topic=${topic}`;
});



function populateTopicDropdown() {
    const topics = getAllTopics(); // Use the function from all-topics.js
    const topicSelect = document.getElementById('topic');

    for (const topic of topics) {
        const option = document.createElement('option');
        option.value = topic;
        option.innerText = topic;
        topicSelect.appendChild(option);
    }
}

// Populate the topic dropdown list on page load
document.addEventListener('DOMContentLoaded', () => {
    populateTopicDropdown();
});
