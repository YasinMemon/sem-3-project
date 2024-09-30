// Modal functionality
const createBlogBtn = document.getElementById('createBlogBtn');
const modal = document.getElementById('createModal');
const closeModal = document.getElementById('closeModal');

if (createBlogBtn && modal) {
    createBlogBtn.onclick = function() {
        modal.style.display = 'flex';
    }

    closeModal.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
}
