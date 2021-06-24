// Search the blog DB
function submitSearch() {
   // Get search term entered by user
   var searchTerm = document.getElementById("search-box").value;
   
   // Debug
   console.log("User searched: " + searchTerm);

   document.searchForm.submit();
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
         $("#search-box").val("topic:" + topicTerm);
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