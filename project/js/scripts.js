// JavaScript for handling search functionality

// Function to handle form submission
document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission behavior
    let searchInput = document.getElementById("searchInput").value; // Get search query
    if (searchInput.trim() !== "") { // Check if search query is not empty
        // Call function to fetch search results
        fetchSearchResults(searchInput);
    }
});

// Function to fetch search results from server
function fetchSearchResults(query) {
    // Example: Assuming you have a backend endpoint to handle search functionality
    let endpoint = `search.php?query=${encodeURIComponent(query)}`;
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            displaySearchResults(data); // Display search results on success
        })
        .catch(error => {
            console.error('There was a problem with your fetch operation:', error);
        });
}

// Function to display search results on the page
function displaySearchResults(results) {
    let searchResultsDiv = document.getElementById("searchResults");
    // Clear previous search results
    searchResultsDiv.innerHTML = "";
    // Iterate through search results and create HTML elements to display them
    results.forEach(result => {
        let resultElement = document.createElement("div");
        resultElement.classList.add("search-result");
        resultElement.innerHTML = `
            <h3>${result.rankName}</h3>
            <p><strong>Address:</strong> ${result.address}</p>
            <p><strong>Operating Hours:</strong> ${result.operatingHours}</p>
            <p><strong>Taxi Association:</strong> ${result.taxiAssociation}</p>
        `;
        searchResultsDiv.appendChild(resultElement);
    });
}
