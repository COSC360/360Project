function renderPosts(topicId) {
const postsContainer = document.getElementById('posts-container');

// Fetch topic data from server
fetch(`get-topic.php?id=${topicId}`)
    .then(response => response.json())
    .then(data => {
        // Set topic title
        document.getElementById('topic-title').innerText = `Topic: ${data.title}`;

        // Render posts
        let postsHTML = '';
        for (const post of data.posts) {
            postsHTML += generatePostCard(post);
        }
        postsContainer.innerHTML = postsHTML;

        // Update subscribe button
        updateSubscribeButton(data.subscribed);
    })
    .catch(error => console.error(error));
}

// Get the topic ID from the URL
const urlParams = new URLSearchParams(window.location.search);
const topicId = urlParams.get('topic_id');

// Render the topic title and posts on page load
document.addEventListener('DOMContentLoaded', () => {
    renderPosts(topicId);
});

// Update subscription status when subscribe button is clicked
subscribeButton.addEventListener('click', () => {
    toggleSubscription(topicId);
    updateSubscribeButton();
});

// Redirect to create post page when button is clicked
createPostButton.addEventListener('click', () => {
    window.location.href = `create-post.html?id=${topicId}`;
});