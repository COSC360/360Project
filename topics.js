// Get a reference to the topics list
var topicsList = document.getElementById('topics-list');

// Loop through each topic in the list
for (var i = 0; i < topicsList.children.length; i++) {
    // Get a reference to the current topic element
    var topic = topicsList.children[i];
    
    // Get the topic title from the element's text content
    var topicTitle = topic.textContent;
    
    // Add a click event listener to the topic element
    topic.addEventListener('click', function() {
        // Navigate to the topic's webpage
        window.location.href = 'topic.php?title=' + encodeURIComponent(topicTitle);
    });
    
    // Add a subscribe button to the topic element
    var subscribeButton = document.createElement('button');
    subscribeButton.textContent = 'Subscribe';
    subscribeButton.classList.add('btn', 'btn-primary', 'mb-2');
    topic.appendChild(subscribeButton);
}