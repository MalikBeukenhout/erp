document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
    document.getElementById('hours-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('Submit_ERP.php', {
            method: 'POST',
            body: formData
        })

        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Show section based on clicked link
    window.showSection = function(sectionId) {
        document.querySelectorAll('main section').forEach(section => {
            section.classList.add('hidden');
        });
        document.getElementById(sectionId).classList.remove('hidden');
    }


    document.addEventListener('DOMContentLoaded', function() {
        // Toggle sidebar function
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var main = document.querySelector("main");
            var toggleBtn = document.getElementById("toggle-sidebar");
    
            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
                main.style.marginLeft = "0";
                toggleBtn.innerHTML = "☰";
            } else {
                sidebar.style.width = "250px";
                main.style.marginLeft = "250px";
                toggleBtn.innerHTML = "✖";
            }
        }
    
        // Event listener for toggle button
        document.getElementById("toggle-sidebar").addEventListener("click", toggleSidebar);
    });
    
