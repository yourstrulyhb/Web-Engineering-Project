// Search blog
function searchBlog() {
   // Get search term entered by user
   var searchTerm = document.getElementById("search-box").value;

   // Validate search term
   // If search term is an empty string, reset texts
   if (searchTerm == "") {
      document.getElementById("search-notifier").innerHTML = "";
      document.getElementById("current-blogs").innerHTML = "Recent blogs";
      
      return false;
   }

   // If search term is not an empty string, modify texts
   document.getElementById("search-box").value = searchTerm;
   document.getElementById("search-notifier").innerHTML = ("You searched blogs related to " + searchTerm);
   document.getElementById("current-blogs").innerHTML = ("Blogs related to " + "'" + searchTerm + "'");
   
   // Debug
   console.log("User searched: " + searchTerm);

   return true;
}

// Event listener; Enter key in search bar
var searchInput = document.getElementById("search-box");
searchInput.addEventListener("keyup", function (event) {
   if (event.keyCode === 13) {
      event.preventDefault();
      // Click search-button 
      document.getElementById("search-button").click();
   }
});

// Validate Contact Form
function validateContactForm() {
   var senderName = document.forms["contactForm"]["name"].value;
   var senderEmail = document.forms["contactForm"]["email"].value;
   var senderMessage = document.forms["contactForm"]["message"].value;
   
   if (senderName == "") {
      senderName = "/anonymous"; 
   }
   alert("Thank you for sending your message!");
   return true;
}

// JQuery
// Topics Dropdown menu
var topicTerm;
$(document).ready(function () {
   $(".dropdownbox").click(function () {
      $(".menu").toggleClass("showMenu");
      $(".menu > li").unbind().click(function () {
         // Get topic selected
         topicTerm = $(this).text();

         // Update dropdown name
         $(".dropdownbox > p").text(topicTerm);
         $(".menu").removeClass("showMenu"); 

         // Update search box and click search button
         $("#search-box").val("topic:" + topicTerm);
         $("#search-notifier").text("You searched blog related to " + topicTerm);
         $("#current-blogs").text("Blogs related to " + topicTerm);
         
         $('#search-button').click();
      });
   });  
});

// Responsive header navigation
$(document).ready(function() {
   $('.menu-toggle').on('click', function() {
      $('.nav').toggleClass('showing');
      $('.nav ul').toggleClass('showing')
   });
});
