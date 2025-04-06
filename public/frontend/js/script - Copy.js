




// Header sticky

$(document).ready(function() {
        // Get the position of the top bar area
        var stickyBar = $('#stickyBar');
        var stickyOffset = stickyBar.offset().top;
        // On scroll event
        $(window).on('scroll', function() {
          var scrollTop = $(this).scrollTop();
          // Check if scrolled past the sticky point
          if (scrollTop > stickyOffset) {
            stickyBar.addClass('sticky'); // Make the bar sticky
            $('#smallSearchBox').fadeIn(); // Show the small search box
            $('#largeSearchBox').fadeOut(); // Hide the large search box
          } else {
            stickyBar.removeClass('sticky'); // Remove sticky behavior
            $('#smallSearchBox').fadeOut(); // Hide the small search box
            $('#largeSearchBox').fadeIn(); // Show the large search box
          }
        });
      });




	$(document).ready(function() {
	    // On click of the small search box
	    $('#smallSearchBox').on('click', function() {
	      // Hide the small search box
	      $(this).fadeOut();
	      // Show the large search box
	      $('#largeSearchBox').fadeIn();
	    });
	  });


	// Search Option toggle

	 const checkinInput = document.getElementById('checkin');
      const checkoutInput = document.getElementById('checkout');
      const calendarPopup = document.getElementById('calendar-popup');
      const calendarMonth = document.getElementById('calendarMonth');
      const calendar = document.getElementById('calendar');
      let selectedCheckinDate = null;
      let selectedCheckoutDate = null;
      let currentMonth = new Date();
      const today = new Date(); // Get today's date
      function showCalendar(input) {
        calendarPopup.style.display = 'block';
        calendarPopup.style.top = input.getBoundingClientRect().bottom + 'px';
        calendarPopup.style.left = input.getBoundingClientRect().left + 'px';
        renderCalendar(currentMonth);
      }

      function hideCalendar() {
        calendarPopup.style.display = 'none';
      }

      function renderCalendar(month) {
        const firstDay = new Date(month.getFullYear(), month.getMonth(), 1);
        const lastDay = new Date(month.getFullYear(), month.getMonth() + 1, 0);
        calendarMonth.textContent = month.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long'
        });
        calendar.innerHTML = '';
        // Add empty cells for days before the start of the month
        for (let i = 0; i < firstDay.getDay(); i++) {
          const emptyCell = document.createElement('div');
          emptyCell.classList.add('disabled');
          calendar.appendChild(emptyCell);
        }
        for (let day = 1; day <= lastDay.getDate(); day++) {
          const date = new Date(month.getFullYear(), month.getMonth(), day);
          const dayCell = document.createElement('div');
          dayCell.textContent = day;
          // Disable previous and current dates
          if (date < today) {
            dayCell.classList.add('disabled'); // Disable past dates
          } else if (selectedCheckinDate && date.getTime() === selectedCheckinDate.getTime()) {
            dayCell.classList.add('selected');
          } else if (selectedCheckoutDate && date.getTime() === selectedCheckoutDate.getTime()) {
            dayCell.classList.add('selected');
          }
          // If the date is in the future, allow it to be selected
          if (date >= today) {
            dayCell.addEventListener('click', () => handleDateSelection(date));
          }
          calendar.appendChild(dayCell);
        }
      }

      function handleDateSelection(date) {
        if (!selectedCheckinDate || (selectedCheckinDate && selectedCheckoutDate)) {
          selectedCheckinDate = date;
          selectedCheckoutDate = null;
          checkinInput.value = formatDate(selectedCheckinDate);
          checkoutInput.value = '';
        } else if (date > selectedCheckinDate) {
          selectedCheckoutDate = date;
          checkoutInput.value = formatDate(selectedCheckoutDate);
        }
        renderCalendar(currentMonth);
        hideCalendar();
      }

      function formatDate(date) {
        return date.toLocaleDateString('en-GB'); // International date format
      }
      document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth.setMonth(currentMonth.getMonth() - 1);
        renderCalendar(currentMonth);
      });
      document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth.setMonth(currentMonth.getMonth() + 1);
        renderCalendar(currentMonth);
      });
      checkinInput.addEventListener('click', () => showCalendar(checkinInput));
      checkoutInput.addEventListener('click', () => showCalendar(checkoutInput));
      document.addEventListener('click', (event) => {
        if (!calendarPopup.contains(event.target) && event.target !== checkinInput && event.target !== checkoutInput) {
          hideCalendar();
        }
      });




       //Seache hotel list
	      function showSuggestions() {
	        document.getElementById("suggestions-list").style.display = "block";
	      }

	      function hideSuggestions() {
	        setTimeout(function() {
	          document.getElementById("suggestions-list").style.display = "none";
	        }, 200); // delay hiding so click events can register
	      }
	      document.querySelectorAll('.suggestion-item').forEach(item => {
	        item.addEventListener('click', function() {
	          document.getElementById('destination-input').value = this.querySelector('strong').innerText;
	          hideSuggestions();
	        });
	      });


        // mobile serach destinations

        function showSuggestions() {
          const suggestionsList = document.getElementById("suggestions-list");
          suggestionsList.style.display = "block";
        }

        function hideSuggestions() {
          setTimeout(function() {
            const suggestionsList = document.getElementById("suggestions-list");
            suggestionsList.style.display = "none";
          }, 200); // delay for click events
        }

        // Event Delegation to handle clicks
        document.getElementById("suggestions-list").addEventListener("click", function(event) {
          const clickedItem = event.target.closest(".suggestion-item");
          if (clickedItem) {
            document.getElementById("destination-input").value = clickedItem.querySelector("strong").innerText;
            hideSuggestions();
          }
        });






	 //Bottom Sticky Bar
	$(document).ready(function() {
        // Get the position where the second sticky bar should become fixed
        var bottomStickyOffset = $('#bottomStickyBar').offset().top;
        $(window).on('scroll', function() {
          var scrollTop = $(this).scrollTop();
          // When the user scrolls past the point, make the bottom sticky bar fixed
          if (scrollTop > bottomStickyOffset - 150) { // Adjust for the 150px offset
            $('#bottomStickyBar').addClass('sticky');
          } else {
            $('#bottomStickyBar').removeClass('sticky');
          }
        });
      });





  // Get modal and elements
        var loginModal = document.getElementById("loginModal");
        var signupModal = document.getElementById("signupModal");
        var loginMenu = document.getElementById("loginMenu");
        var closeLogin = document.getElementById("closeLogin");
        var closeSignup = document.getElementById("closeSignup");
        var signupLink = document.getElementById("signupLink");
        var loginLink = document.getElementById("loginLink");
        var forgotPasswordLink = document.getElementById("forgotPassword");
        // Open login modal when clicking "Login" menu
        loginMenu.onclick = function() {
          loginModal.style.display = "block";
        }
        // Open signup modal when clicking "Sign Up" link in login modal
        signupLink.onclick = function() {
          loginModal.style.display = "none"; // Close login modal
          signupModal.style.display = "block"; // Show signup modal
        }
        // Open login modal when clicking "Login" icon link in signup modal footer
        loginLink.onclick = function() {
          signupModal.style.display = "none"; // Close signup modal
          loginModal.style.display = "block"; // Show login modal
        }
        // Close login modal when clicking "x"
        closeLogin.onclick = function() {
          loginModal.style.display = "none";
        }
        // Close signup modal when clicking "x"
        closeSignup.onclick = function() {
          signupModal.style.display = "none";
        }
        // Close modal if the user clicks anywhere outside of the modal content
        window.onclick = function(event) {
          if (event.target == loginModal) {
            loginModal.style.display = "none";
          } else if (event.target == signupModal) {
            signupModal.style.display = "none";
          }
        }

 // toggle sidebar

          document.addEventListener('DOMContentLoaded', function() {
          const profileIconToggle = document.getElementById('profileIconToggle');
          const userSubmenu = document.getElementById('userSubmenu');
          // Toggle submenu visibility
          profileIconToggle.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior (if any)
            // Toggle visibility of the submenu
            if (userSubmenu.style.display === 'block') {
              userSubmenu.style.display = 'none'; // Hide submenu if it's visible
            } else {
              userSubmenu.style.display = 'block'; // Show submenu if it's hidden
            }
          });
          // Close the submenu if the user clicks outside of it
          document.addEventListener('click', function(event) {
            if (!profileIconToggle.contains(event.target) && !userSubmenu.contains(event.target)) {
              userSubmenu.style.display = 'none'; // Hide submenu if clicked outside
            }
          });
        });



      // Toggle the guest dropdown visibility
      function toggleGuestDropdown() {
        const guestSelector = document.querySelector('.guest-selector');
        guestSelector.classList.toggle('show');
      }
      // Increase count based on the id passed (for adults, children, infants, or pets)
      function increaseCount(id) {
        let count = document.getElementById(id).innerText;
        count = parseInt(count) + 1;
        document.getElementById(id).innerText = count;
        updateGuestButtonText();
      }
      // Decrease count (ensuring it doesn't go below 0)
      function decreaseCount(id) {
        let count = document.getElementById(id).innerText;
        count = parseInt(count);
        if (count > 0) {
          count -= 1;
        }
        document.getElementById(id).innerText = count;
        updateGuestButtonText();
      }
      // Update the guest button text to show the total count of guests
      function updateGuestButtonText() {
        const adultCount = parseInt(document.getElementById('adultCount').innerText);
        const childrenCount = parseInt(document.getElementById('childrenCount').innerText);
        const infantCount = parseInt(document.getElementById('infantCount').innerText);
        const petCount = parseInt(document.getElementById('petCount').innerText);
        let totalGuests = adultCount + childrenCount;
        let guestText = "";
        if (totalGuests > 0) {
          guestText += `${totalGuests} guest${totalGuests > 1 ? 's' : ''}`;
        }
        if (infantCount > 0) {
          guestText += `, ${infantCount} infant${infantCount > 1 ? 's' : ''}`;
        }
        if (petCount > 0) {
          guestText += `, ${petCount} pet${petCount > 1 ? 's' : ''}`;
        }
        // If no guests selected, show "Add Guests"
        if (guestText === "") {
          guestText = "Add Guests";
        }
        document.querySelector('.guest-button').innerText = guestText;
      }
      // Close guest-selector when clicking outside the dropdown
      window.addEventListener('click', function(e) {
        const guestSelector = document.querySelector('.guest-selector');
        const guestButton = document.querySelector('.guest-button');
        // Check if click is outside the guestSelector and the guest button
        if (!guestSelector.contains(e.target) && !guestButton.contains(e.target)) {
          guestSelector.classList.remove('show');
        }
      });





//Hotel Tabbing Slider
   document.getElementById('exampleModal').addEventListener('shown.bs.modal', function () {
        if (typeof mySwiper !== 'undefined') {
            mySwiper.update(); // Refresh the Swiper slider
        }
    });

// modal right Side bar
    document.getElementById('exampleModal').addEventListener('shown.bs.modal', function () {
    // Initialize or refresh the slider in the active tab
    $('.slider').slick('setPosition'); // Recalculates dimensions
});



    document.querySelectorAll('.nav-tabing-custom a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            const offset = 130;
            const topPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: topPosition,
                behavior: 'smooth'
            });
        });
    });



 // Initialize tooltips
$(function () {
    
        $('[data-toggle="tooltip"]').tooltip();
    })


const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
tooltipTriggerList.forEach(function (tooltipTriggerEl) {
  new bootstrap.Tooltip(tooltipTriggerEl);
});