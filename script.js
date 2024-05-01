document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("investor").addEventListener("click", function() {
        document.getElementById("investor-details").style.display = "block";
        document.getElementById("startup-details").style.display = "none";
    });

    document.getElementById("startup").addEventListener("click", function() {
        document.getElementById("investor-details").style.display = "none";
        document.getElementById("startup-details").style.display = "block";
    });
});
