// Sample data
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

// Function to generate post cards
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

// Render posts
function renderPosts(filteredPosts) {
    const postsContainer = document.getElementById('posts-container');
    let postsHTML = '';

    for (const post of filteredPosts) {
        postsHTML += generatePostCard(post);
    }

    postsContainer.innerHTML = postsHTML;
}

// Search posts by title
function searchPosts(searchText) {
    return posts.filter(post => post.title.toLowerCase().includes(searchText.toLowerCase()));
}

// Handle search input
document.getElementById('search-input').addEventListener('input', (e) => {
    const searchText = e.target.value;
    const filteredPosts = searchPosts(searchText);
    renderPosts(filteredPosts);
});

// Call renderPosts function on page load
document.addEventListener('DOMContentLoaded', () => renderPosts(posts));

