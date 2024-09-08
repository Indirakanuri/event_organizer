let menu = document.querySelector("#menu-bars");
let navbar = document.querySelector(".navbar");

menu.onclick = () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
};

let themeToggler = document.querySelector(".theme-toggler");
let toggleBtn = document.querySelector(".toggle-btn");

toggleBtn.onclick = () => {
  themeToggler.classList.toggle("active");
};

window.onscroll = () => {
  menu.classList.remove("fa-times");
  navbar.classList.remove("active");
  themeToggler.classList.remove("active");
};

document.querySelectorAll(".theme-toggler .theme-btn").forEach((btn) => {
  btn.onclick = () => {
    let color = btn.style.background;
    document.querySelector(":root").style.setProperty("--theme-color", color);
  };
});

var swiper = new Swiper(".home-slider", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 100,
    modifier: 2,
    slideShadows: true,
  },
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});

var swiper = new Swiper(".review-slider", {
  slidesPerView: 1,
  grabCursor: true,
  loop: true,
  spaceBetween: 10,
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    700: {
      slidesPerView: 2,
    },
    1050: {
      slidesPerView: 3,
    },
  },
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },

});
function show3DEffect(element) {
  // Remove 'active' class from all boxes
  const boxes = document.querySelectorAll('.service .box-container .box');
  boxes.forEach(box => box.classList.remove('active'));

  // Add 'active' class to the clicked box
  element.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('submitBtn').addEventListener('click', function() {
    var form = document.getElementById('contactForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true);

    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('statusMsg').innerHTML = 'Message sent successfully!';
        form.reset(); // Optional: Clear form inputs after successful submission
      } else {
        document.getElementById('statusMsg').innerHTML = 'Error sending message. Please try again later.';
      }
    };

    xhr.onerror = function() {
      document.getElementById('statusMsg').innerHTML = 'Network error occurred. Please try again later.';
    };

    xhr.send(formData);
  });
});
function showPage(pageId) {
  // Hide all sections
  document.querySelectorAll('section').forEach(section => {
    section.style.display = 'none';
  });

  // Show the selected section
  document.getElementById(pageId).style.display = 'block';
}
