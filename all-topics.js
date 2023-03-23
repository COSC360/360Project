async function fetchTopics() {
    try {
        const response = await fetch(API_URL);
        const topics = await response.json();
        return topics;
    } catch (error) {
        console.error('Error fetching topics:', error);
        return [];
    }
}

function generateTopicListItem(topic) {
    return `
    <li class="list-group-item">
        <a href="topic.html?topic=${topic}">${topic}</a>
    </li>`;
}

async function renderTopics() {
    const topicsList = document.getElementById('topics-list');
    const topics = await fetchTopics();
    let topicsHTML = '';

    for (const topic of topics) {
        topicsHTML += generateTopicListItem(topic);
    }

    topicsList.innerHTML = topicsHTML;
}

// Render the topics on page load
document.addEventListener('DOMContentLoaded', () => {
    renderTopics();
});

export { renderTopics };