




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


	// Search Option toggle Check in and Check Out for mobile






// Desktop and mobile view calender


  document.addEventListener("DOMContentLoaded", function () {
  // Mobile View Variables
  const checkinInputMobile = document.getElementById("checkin-mobile");
  const checkoutInputMobile = document.getElementById("checkout-mobile");
  const calendarPopupMobile = document.getElementById("calendar-popup-mobile");
  const calendarMonthMobile = document.getElementById("calendarMonth-mobile");
  const calendarMobile = document.getElementById("calendar-mobile");

  // Desktop View Variables
  const checkinInputDesktop = document.getElementById("checkin-desktop");
  const checkoutInputDesktop = document.getElementById("checkout-desktop");
  const calendarPopupDesktop = document.getElementById("calendar-popup-desktop");
  const calendarMonthDesktop = document.getElementById("calendarMonth-desktop");
  const calendarDesktop = document.getElementById("calendar-desktop");

  let selectedCheckinDate = null;
  let selectedCheckoutDate = null;
  let currentMonth = new Date();
  const today = new Date();

  // Show calendar popup for mobile view
  function showCalendarMobile(input) {
    calendarPopupMobile.style.display = "block";
    calendarPopupMobile.dataset.target = input.id; // Store which input is active

    const rect = input.getBoundingClientRect();
    calendarPopupMobile.style.top = rect.bottom + window.scrollY + "px";
    calendarPopupMobile.style.left = rect.left + window.scrollX + "px";

    renderCalendarMobile(currentMonth);
  }

  // Show calendar popup for desktop view
  function showCalendarDesktop(input) {
    calendarPopupDesktop.style.display = "block";
    calendarPopupDesktop.dataset.target = input.id; // Store which input is active

    const rect = input.getBoundingClientRect();
    calendarPopupDesktop.style.top = rect.bottom + "px";
    calendarPopupDesktop.style.left = rect.left + "px";

    renderCalendarDesktop(currentMonth);
  }

  // Hide calendar popup
  function hideCalendar() {
    calendarPopupMobile.style.display = "none";
    calendarPopupDesktop.style.display = "none";
  }

  // Render calendar for mobile view
  function renderCalendarMobile(month) {
    const firstDay = new Date(month.getFullYear(), month.getMonth(), 1);
    const lastDay = new Date(month.getFullYear(), month.getMonth() + 1, 0);

    calendarMonthMobile.textContent = month.toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
    });

    calendarMobile.innerHTML = ""; // Clear previous calendar content

    for (let i = 0; i < firstDay.getDay(); i++) {
      const emptyCell = document.createElement("div");
      emptyCell.classList.add("disabled");
      calendarMobile.appendChild(emptyCell);
    }

    for (let day = 1; day <= lastDay.getDate(); day++) {
      const date = new Date(month.getFullYear(), month.getMonth(), day);
      const dayCell = document.createElement("div");
      dayCell.textContent = day;
      dayCell.style.cursor = "pointer";

      if (date < today) {
        dayCell.classList.add("disabled");
      } else if (selectedCheckinDate && date.getTime() === selectedCheckinDate.getTime()) {
        dayCell.classList.add("selected");
      } else if (selectedCheckoutDate && date.getTime() === selectedCheckoutDate.getTime()) {
        dayCell.classList.add("selected");
      }

      dayCell.addEventListener("click", () => handleDateSelection(date, "mobile"));
      calendarMobile.appendChild(dayCell);
    }
  }

  // Render calendar for desktop view
  function renderCalendarDesktop(month) {
    const firstDay = new Date(month.getFullYear(), month.getMonth(), 1);
    const lastDay = new Date(month.getFullYear(), month.getMonth() + 1, 0);

    calendarMonthDesktop.textContent = month.toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
    });

    calendarDesktop.innerHTML = ""; // Clear previous calendar content

    for (let i = 0; i < firstDay.getDay(); i++) {
      const emptyCell = document.createElement("div");
      emptyCell.classList.add("disabled");
      calendarDesktop.appendChild(emptyCell);
    }

    for (let day = 1; day <= lastDay.getDate(); day++) {
      const date = new Date(month.getFullYear(), month.getMonth(), day);
      const dayCell = document.createElement("div");
      dayCell.textContent = day;
      dayCell.style.cursor = "pointer";

      if (date < today) {
        dayCell.classList.add("disabled");
      } else if (selectedCheckinDate && date.getTime() === selectedCheckinDate.getTime()) {
        dayCell.classList.add("selected");
      } else if (selectedCheckoutDate && date.getTime() === selectedCheckoutDate.getTime()) {
        dayCell.classList.add("selected");
      }

      dayCell.addEventListener("click", () => handleDateSelection(date, "desktop"));
      calendarDesktop.appendChild(dayCell);
    }
  }

  // Handle date selection for both mobile and desktop
  function handleDateSelection(date, view) {
    const targetInput = (view === "mobile") ? calendarPopupMobile.dataset.target : calendarPopupDesktop.dataset.target;

    if (targetInput === "checkin-" + view) {
      selectedCheckinDate = date;
      selectedCheckoutDate = null;
      (view === "mobile" ? checkinInputMobile : checkinInputDesktop).value = formatDate(selectedCheckinDate);
      (view === "mobile" ? checkoutInputMobile : checkoutInputDesktop).value = "";
    } else if (targetInput === "checkout-" + view && date > selectedCheckinDate) {
      selectedCheckoutDate = date;
      (view === "mobile" ? checkoutInputMobile : checkoutInputDesktop).value = formatDate(selectedCheckoutDate);
    }

    (view === "mobile" ? renderCalendarMobile : renderCalendarDesktop)(currentMonth);
    hideCalendar();
  }

  // Format date to dd/mm/yyyy format
  function formatDate(date) {
    return date.toLocaleDateString("en-GB");
  }

  // Change month (previous or next) for both mobile and desktop
  document.getElementById("prevMonth-mobile").addEventListener("click", () => {
    currentMonth.setMonth(currentMonth.getMonth() - 1);
    renderCalendarMobile(currentMonth);
  });

  document.getElementById("nextMonth-mobile").addEventListener("click", () => {
    currentMonth.setMonth(currentMonth.getMonth() + 1);
    renderCalendarMobile(currentMonth);
  });

  document.getElementById("prevMonth-desktop").addEventListener("click", () => {
    currentMonth.setMonth(currentMonth.getMonth() - 1);
    renderCalendarDesktop(currentMonth);
  });

  document.getElementById("nextMonth-desktop").addEventListener("click", () => {
    currentMonth.setMonth(currentMonth.getMonth() + 1);
    renderCalendarDesktop(currentMonth);
  });

  // Show calendar when checkin or checkout input is clicked (Mobile & Desktop)
  checkinInputMobile.addEventListener("click", () => showCalendarMobile(checkinInputMobile));
  checkoutInputMobile.addEventListener("click", () => showCalendarMobile(checkoutInputMobile));

  checkinInputDesktop.addEventListener("click", () => showCalendarDesktop(checkinInputDesktop));
  checkoutInputDesktop.addEventListener("click", () => showCalendarDesktop(checkoutInputDesktop));

  // Hide calendar if click happens outside the popup
  document.addEventListener("click", (event) => {
    if (!calendarPopupMobile.contains(event.target) && !calendarPopupDesktop.contains(event.target) &&
        event.target !== checkinInputMobile && event.target !== checkoutInputMobile &&
        event.target !== checkinInputDesktop && event.target !== checkoutInputDesktop) {
      hideCalendar();
    }
  });
});









       //Search hotel list Mobile

        function showMobileSuggestions() {
          document.getElementById("mobile-suggestions-list").style.display = "block";
        }

        function hideMobileSuggestions() {
          setTimeout(function() {
            document.getElementById("mobile-suggestions-list").style.display = "none";
          }, 200); // Delay for click events
        }

        document.querySelectorAll("#mobile-suggestions-list .suggestion-item").forEach(item => {
          item.addEventListener("click", function () {
            document.getElementById("mobile-destination-input").value = this.querySelector("strong").innerText;
            hideMobileSuggestions();
          });
        });



        //Search hotel list Desktop

        function showDesktopSuggestions() {
          document.getElementById("desktop-suggestions-list").style.display = "block";
        }

        function hideDesktopSuggestions() {
          setTimeout(function() {
            document.getElementById("desktop-suggestions-list").style.display = "none";
          }, 200); // Delay for click events
        }

        document.querySelectorAll("#desktop-suggestions-list .suggestion-item").forEach(item => {
          item.addEventListener("click", function () {
            document.getElementById("desktop-destination-input").value = this.querySelector("strong").innerText;
            hideDesktopSuggestions();
          });
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

document.addEventListener('DOMContentLoaded', function () {
    // Desktop Elements
    const desktopIcon = document.getElementById('profileIconDesktop');
    const desktopMenu = document.getElementById('userSubmenuDesktop');

    // Mobile Elements
    const mobileIcon = document.getElementById('profileIconMobile');
    const mobileMenu = document.getElementById('userSubmenuMobile');

    function toggleMenu(menu) {
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }

    // Toggle desktop menu
    desktopIcon.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        toggleMenu(desktopMenu);
    });

    // Toggle mobile menu
    mobileIcon.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        toggleMenu(mobileMenu);
    });

    // Hide menus when clicking outside
    document.addEventListener('click', function (event) {
        if (!desktopIcon.contains(event.target) && !desktopMenu.contains(event.target)) {
            desktopMenu.style.display = 'none';
        }
        if (!mobileIcon.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.style.display = 'none';
        }
    });

    // Hide desktop menu on window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            mobileMenu.style.display = 'none';
        }
        if (window.innerWidth <= 768) {
            desktopMenu.style.display = 'none';
        }
    });
});

// Toggle user profile dropdown menu
document.addEventListener('DOMContentLoaded', function () {
    const profileIconToggle = document.getElementById('profileIconToggle');
    const userSubmenu = document.getElementById('userSubmenu');
    
    if (profileIconToggle && userSubmenu) {
        // Use event delegation on the document to catch all clicks
        profileIconToggle.onclick = function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            // Toggle the dropdown
            if (userSubmenu.style.display === 'block' || userSubmenu.classList.contains('show')) {
                userSubmenu.style.display = 'none';
                userSubmenu.classList.remove('show');
            } else {
                userSubmenu.style.display = 'block';
                userSubmenu.classList.add('show');
            }
            return false;
        };
        
        // Close the submenu if the user clicks outside of it
        document.addEventListener('click', function (event) {
            if (profileIconToggle && userSubmenu) {
                const clickedInsideToggle = profileIconToggle.contains(event.target);
                const clickedInsideMenu = userSubmenu.contains(event.target);
                
                if (!clickedInsideToggle && !clickedInsideMenu) {
                    if (userSubmenu.style.display === 'block' || userSubmenu.classList.contains('show')) {
                        userSubmenu.style.display = 'none';
                        userSubmenu.classList.remove('show');
                    }
                }
            }
        });
    }
});







      // Toggle the guest dropdown visibility Mobiole view


// Toggle guest dropdown for mobile or desktop
function toggleGuestDropdown(view) {
  const guestSelector = document.querySelector(`#guest-selector-${view}`);
  guestSelector.classList.toggle('show');
}

// Increase count for mobile or desktop view
function increaseCount(view, id) {
  let count = document.getElementById(`${id}${capitalize(view)}`).innerText;
  count = parseInt(count) + 1;
  document.getElementById(`${id}${capitalize(view)}`).innerText = count;
  updateGuestButtonText(view);
}

// Decrease count for mobile or desktop view
function decreaseCount(view, id) {
  let count = document.getElementById(`${id}${capitalize(view)}`).innerText;
  count = parseInt(count);
  if (count > 0) {
    count -= 1;
  }
  document.getElementById(`${id}${capitalize(view)}`).innerText = count;
  updateGuestButtonText(view);
}

// Update the guest button text based on selected guests for mobile or desktop
function updateGuestButtonText(view) {
  const adultCount = parseInt(document.getElementById(`adultCount${capitalize(view)}`).innerText);
  const childrenCount = parseInt(document.getElementById(`childrenCount${capitalize(view)}`).innerText);
  const infantCount = parseInt(document.getElementById(`infantCount${capitalize(view)}`).innerText);
  const petCount = parseInt(document.getElementById(`petCount${capitalize(view)}`).innerText);
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
  if (guestText === "") {
    guestText = "Add Guests";
  }

  // Update the correct button (mobile or desktop)
  const button = document.querySelector(`#guest-dropdown-${view} .guest-button`);
  button.innerText = guestText;
}

// Helper function to capitalize first letter of view (mobile or desktop)
function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// Close dropdown if clicked outside
window.addEventListener('click', function (e) {
  const guestSelectors = document.querySelectorAll('.guest-selector');
  guestSelectors.forEach(function (guestSelector) {
    const guestButton = guestSelector.previousElementSibling;
    if (!guestSelector.contains(e.target) && !guestButton.contains(e.target)) {
      guestSelector.classList.remove('show');
    }
  });
});




// Mobile view Search Bar pop up
        const searchBar = document.getElementById("searchBar");
        const searchBtn = document.getElementById("searchBtn");
        const overlay = document.getElementById("overlay");

        // Show the expanded search bar when clicking the search button
        searchBtn.addEventListener("click", function () {
            searchBar.classList.add("fullscreen");
            overlay.style.display = "block"; // Show overlay
        });

        // Hide search bar when clicking outside
        overlay.addEventListener("click", function () {
            searchBar.classList.remove("fullscreen");
            overlay.style.display = "none"; // Hide overlay
        });
   

        // Scrolll bottom to top Arrow Button
        let scrollTopBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollTopBtn.style.display = "block";
            } else {
                scrollTopBtn.style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }



        // Scrolll bottom to top  Search bar
        document.addEventListener("DOMContentLoaded", function () {
    let searchBtn = document.getElementById("searchBtn");
    let lastScrollTop = 0;

    window.addEventListener("scroll", function () {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Show button when scrolling down
            searchBtn.style.display = "block";
        } else if (currentScroll < 100) {
            // Hide button when near the top
            searchBtn.style.display = "none";
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });
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