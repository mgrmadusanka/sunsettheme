$(document).ready(function(){
    //variable declarations
    


    //gallery post type carousel
    function activateOwlCarousel() {
        $(document).find('.owl-carousel').owlCarousel({
            items: 1,
            autoplay: false,
            loop: true,
            nav: true,
            navText: ['<span class="sunset-icon sunset-chevron-left"></span>', '<span class="sunset-icon sunset-chevron-right"></span>']
        });
    }
    activateOwlCarousel();

    //sidebar functions
    $(document).on('click', '.jsSidebarToggle', function() {
        $('.sunsetSidebar').toggleClass('sidebarClosed');
        $('.sidebarOverlay').fadeToggle(500);
        $('body').toggleClass('noScroll');
    });

    //sunset contact form
    $(document).on('submit', '#sunsetContactFormJS', function(e) {
        e.preventDefault();

        var form = $(this),
            name = form.find('#name').val(),
            email = form.find('#email').val(),
            message = form.find('#message').val(),
            ajaxUrl = form.data('url');

        form.find('input, textarea').removeClass('txtError');

        if(name == '') {
            form.find('#name').addClass('txtError').attr('placeholder', 'Your Name cannot be empty!');
            return;
        }
        if(email == '') {
            form.find('#email').addClass('txtError').attr('placeholder', 'Your Email cannot be empty!');
            return;
        }
        if(message == '') {
            form.find('#message').addClass('txtError').attr('placeholder', 'Your Message cannot be empty!');
            return;
        }

        form.find('input, textarea, button').attr('disabled', 'disabled');
        form.find('#info').removeAttr('class').addClass('process').text('Submission in process, please wait...');

        $.ajax({
            url: ajaxUrl,
            type: 'post',
            data: {
                name: name,
                email: email,
                message: message,
                action: 'sunsetSaveUserContactFormData'
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if(response == 0) {
                    setTimeout(function() {
                        form.find('#info').removeAttr('class').addClass('error').text('Unable to send your message, Please try again later');
                        form.find('input, textarea, button').removeAttr('disabled');
                    }, 1500);
                } else {
                    setTimeout(function(){
                        form.find('#info').removeAttr('class').addClass('success').text('Your message sent.');
                        form.find('input, textarea, button').removeAttr('disabled');
                        form[0].reset();
                        form.find('#info').delay(500).fadeOut(300);
                    }, 1000);
                }
            }
        });
    });
});