
 
        // Hide other elements while showing the preloader
        var pageContent = document.getElementById("pageContent");
        var preloader = document.querySelector(".preloader");
        var durationInSeconds = 1; // Change this value to your desired duration in seconds

        pageContent.classList.add("preloader-hidden");

        setTimeout(function() {
            pageContent.classList.remove("preloader-hidden");
            preloader.style.display = "none";
        }, durationInSeconds * 1000);
  