define([
    'jquery',
    'slick'
], function ($) {
    'use strict';

    return function dealspage(dueDate) {
        // Countdown Timer

        var countDownDate = new Date(dueDate).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("dias").innerHTML = days;
            document.getElementById("horas").innerHTML = hours;
            document.getElementById("minutos").innerHTML = minutes;
            document.getElementById("segundos").innerHTML = seconds;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);

        // Slick Sliders
        $(document).ready(function() {
            $(".slide1").slick({
                dots: true,
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });

            $(".slide2").slick({
                dots: true,
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });

            $(".slide3").slick({
                dots: true,
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });
        });
    };
});
