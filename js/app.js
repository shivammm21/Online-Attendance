const reviews_slider = new Swiper('.reviews_slider', {
  loop: true,
  autoplay:
  {
    delay: 2000,
  },
  pagination: {
    el: '.reviews_pagination .swiper-pagination',
    clickable: true,
  },

  navigation: {
    nextEl: '.reviews_slider_control .swiper-button-next',
    prevEl: '.reviews_slider_control .swiper-button-prev',
  },

  breakpoints: {
    0: {
      slidesPerView: 1.15,
      centeredSlides: true,
    },
    650: {
      slidesPerView: 1.2,
    },
    767: {
      slidesPerView: 1.4,
    },
    991: {
      slidesPerView: 1.6,
    },
    1199: {
      slidesPerView: 2,
    },
  },

});

const dropDownData=[]
window.onload = function () {
  aos_init();
}

// Init AOS
function aos_init() {
  AOS.init({
    duration: 1000,
    easing: "ease-in-out",
    once: true,
    mirror: false
  });
}

document.querySelector(".banner__close").addEventListener("click", function () {
  this.closest(".banner").style.display = "none";
  element = document.getElementById('site_header');
  element.style.paddingTop='40px';
});


function closeVideo(e) {
  var iframe = document.getElementById('vid_player');
  console.log(iframe)
  var temp = iframe.src;
  iframe.src = temp;
}




//Login page
/*


*/

