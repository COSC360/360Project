const topics = ['Topic1', 'Topic2', 'Topic3'];

function generateTopicListItem(topic) {
    return `
    <li class="list-group-item">
        <a href="topic.html?topic=${topic}">${topic}</a>
    </li>`;
}

function renderTopics() {
    const topicsList = document.getElementById('topics-list');
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



function isSubscribed(topic) {
    const subscriptions = JSON.parse(localStorage.getItem('subscriptions') || '[]');
    return subscriptions.includes(topic);
}

function toggleSubscription(topic) {
    const subscriptions = JSON.parse(localStorage.getItem('subscriptions') || '[]');
    const index = subscriptions.indexOf(topic);

    if (index === -1) {
        subscriptions.push(topic);
    } else {
        subscriptions.splice(index, 1);
    }

    localStorage.setItem('subscriptions', JSON.stringify(subscriptions));
}

function generateTopicListItem(topic) {
    const subscribed = isSubscribed(topic);
    const buttonText = subscribed ? 'Unsubscribe' : 'Subscribe';

    return `
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="topic.html?topic=${topic}">${topic}</a>
        <button class="btn btn-sm btn-outline-primary" onclick="toggleSubscription('${topic}')">${buttonText}</button>
    </li>`;
}

// Render the topics on page load
document.addEventListener('DOMContentLoaded', () => {
    renderTopics();
});

