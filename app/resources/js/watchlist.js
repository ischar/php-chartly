const watchListDiv = document.getElementById("watch-list");

async function fetchWatchList() {
    try {
        const response = await fetch("/watchlist");
        const watchList = await response.json();
    } catch (error) {
        console.error("Error loading watchlist data:", error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-button');
  
    deleteButtons.forEach(button => {
      button.addEventListener('click', () => {
        const stockId = button.getAttribute('data-stock-id');
        const csrfToken = button.getAttribute('data-csrf-token');
  
        if (confirm('Are you sure you want to delete this stock?')) {
          fetch(`/watchlist/${stockId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Content-Type': 'application/json'
            }
          })
          .then(response => {
            if (response.ok) {
              alert('Stock successfully deleted');
              location.reload(); // Reload the page to reflect changes
            } else {
              alert('Failed to delete stock');
            }
          })
          .catch(error => console.error('Error:', error));
        }
      });
    });
  });

fetchWatchList();

