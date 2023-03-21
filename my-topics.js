function getSubscribedTopics() {
    return JSON.parse(localStorage.getItem('subscriptions') || '[]');
}

function filterTopics(searchTerm) {
    const topics = getSubscribedTopics();
    return topics.filter(topic => topic.toLowerCase().includes(searchTerm.toLowerCase()));
}

function generateTopicListItem(topic) {
    return `
    <li class="list-group-item">
        <a href="topic.html?topic=${topic}">${topic}</a>
    </li>`;
}

function renderTopics(searchTerm = '') {
    const filteredTopics = filterTopics(searchTerm);
    const topicsList = document.getElementById('my-topics-list');
    let topicsHTML = '';

    for (const topic of filteredTopics) {
        topicsHTML += generateTopicListItem(topic);
    }

    topicsList.innerHTML = topicsHTML;
}

document.getElementById('search-input').addEventListener('input', (e) => {
    const searchTerm = e.target.value;
    renderTopics(searchTerm);
});

// Render the topics on page load
document.addEventListener('DOMContentLoaded', () => {
    renderTopics();
});
