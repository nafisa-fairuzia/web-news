$(document).ready(function() {
    $('.yt-slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,        
        autoplaySpeed: 5000,   
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
            }
        ]
    });
});

 document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".counter");
    const duration = 2000; 
    const steps = 60; 
    const interval = duration / steps;

    let currentStep = 0;

    const targets = Array.from(counters).map(c => +c.getAttribute("data-target"));

    const timer = setInterval(() => {
      currentStep++;

      counters.forEach((counter, index) => {
        const target = targets[index];
        const value = Math.floor((target / steps) * currentStep);
        counter.innerText = (value > target) ? target : value;
      });

      if (currentStep >= steps) {
        clearInterval(timer);
        counters.forEach((counter, index) => {
          counter.innerText = targets[index];
        });
      }
    }, interval);
  });