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

const comments = [
    {
        postId: 1,
        author: 'Commenter1',
        content: 'This is a comment on Post 1.',
        date: '2023-03-19'
    },
    {
        postId: 1,
        author: 'Commenter2',
        content: 'This is another comment on Post 1.',
        date: '2023-03-20'
    }
];

function getPostById(id) {
    return posts.find(post => post.id === id);
}

function getCommentsByPostId(postId) {
    return comments.filter(comment => comment.postId === postId);
}

function generatePostHTML(post) {
    return `
        <h2>${post.title}</h2>
        <p>${post.content}</p>
        <p><small class="text-muted">By ${post.author} on ${post.date}</small></p>
    `;
}

function generateCommentHTML(comment) {
    return `
        <div class="card mb-3">
            <div class="card-body">
                <p>${comment.content}</p>
                <p><small class="text-muted">By ${comment.author} on ${comment.date}</small></p>
            </div>
        </div>
    `;
}

function renderPost(post) {
    const postContainer = document.getElementById('post');
    postContainer.innerHTML = `
        <h2>${post.title}</h2>
        <p>${post.content}</p>
        <p><strong>Topic:</strong> <a href="topic.html?topic=${post.topic}">${post.topic}</a></p>
    `;
}

function renderComments(postId) {
    const commentsList = getCommentsByPostId(postId);
    const commentsContainer = document.getElementById('comments-container');
    let commentsHTML = '<h3>Comments</h3>';

    for (const comment of commentsList) {
        commentsHTML += generateCommentHTML(comment);
    }

    commentsContainer.innerHTML = commentsHTML;
}

function handleSubmitComment(e) {
    e.preventDefault();

    // Process the new comment (e.g., save to database, update UI)
    console.log('Comment submitted:', document.getElementById('comment').value); //MUST UPDATE WITH DB LOGIC
}

// Get the postId from the URL
const urlParams = new URLSearchParams(window.location.search);
const postId = Number(urlParams.get('id'));

// Render the post and comments on page load
document.addEventListener('DOMContentLoaded', () => {
    renderPost(postId);
    renderComments(postId);
});

// Listen for comment form submissions
document.getElementById('comment-form').addEventListener('submit', handleSubmitComment);
