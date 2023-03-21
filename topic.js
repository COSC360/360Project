const posts = [
    {
        id: 1,
        title: 'Post 1',
        content: 'This is the content for Post 1.',
        author: 'Author1',
        date: '2023-03-18'
    },
    {
        id: 2,
        title: 'Post 2',
        content: 'This is the content for Post 2.',
        author: 'Author2',
        date: '2023-03-19'
    }
];

function getPostsByTopic(topic) {
    return posts.filter(post => post.topic === topic);
}

function generatePostCard(post) {
    return `
        <div class="card mb-3">
            <div class="card-header">
                <a href="post.html?id=${post.id}">${post.title}</a>
                <span class="badge bg-secondary ms-2">Topic: <a href="topic.html?topic=${post.topic}">${post.topic}</a></span>
            </div>
            <div class="card-body">
                <h5 class="card-title">${post.title}</h5>
                <p class="card-text">${post.content}</p>
                <p class="card-text">
                    <small class="text-muted">By ${post.author} on ${post.date}</small>
                </p>
                <a href="post.html?id=${post.id}" class="btn btn-primary">Read More</a>
            </div>
        </div>`;
}

function renderPosts(topic) {
    const filteredPosts = getPostsByTopic(topic);
    const postsContainer = document.getElementById('posts-container');
    let postsHTML = '';

    for (const post of filteredPosts) {
        postsHTML += generatePostCard(post);
    }

    postsContainer.innerHTML = postsHTML;
}

// Get the topic from the URL
const urlParams = new URLSearchParams(window.location.search);
const topic = urlParams.get('topic');

// Render the topic title and posts on page load
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('topic-title').innerText = `Topic: ${topic}`;
    renderPosts(topic);
});



function updateSubscribeButton() {
    const subscribeButton = document.getElementById('subscribe-button');
    if (isSubscribed(topic)) {
        subscribeButton.innerText = 'Unsubscribe';
    } else {
        subscribeButton.innerText = 'Subscribe';
    }
}

subscribeButton.addEventListener('click', () => {
    toggleSubscription(topic);
    updateSubscribeButton();
});

document.getElementById('create-post-button').addEventListener('click', () => {
    window.location.href = `create-post.html?topic=${encodeURIComponent(topic)}`;
});

// Render the topic title and posts on page load
document.addEventListener('DOMContentLoaded', () => {
    // ... (previous code)
    updateSubscribeButton();
});
