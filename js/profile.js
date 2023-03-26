document.getElementById('edit-user-button').addEventListener('click', () => {
    $('#edit-user-modal').modal('show');
});

document.getElementById('save-changes-button').addEventListener('click', () => {
    // Handle saving changes to user details here (e.g., send a request to your server to update the user)
    // You can access the form values using document.getElementById('edit-user-form') and its elements

    alert('Changes saved!'); // Remove this line when implementing server-side logic

    $('#edit-user-modal').modal('hide');
});
