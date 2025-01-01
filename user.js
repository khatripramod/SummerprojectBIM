
document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.querySelector('.bar');
    var searchResults = document.querySelector('.search-results');

    searchInput.addEventListener('input', function() {
        if (searchInput.value.trim() !== '') {
            // Display the search results container
            searchResults.style.display = 'block';
            // You can add your logic to fetch and display search results here
        } else {
            // Hide the search results container
            searchResults.style.display = 'none';
        }
    });
});
