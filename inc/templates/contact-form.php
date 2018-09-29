<form id="sunsetContactFormJS" class="sunsetContactForm" action="#" method="POST" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="text" name="name" id="name" placeholder="Your Name"/>

    <input type="email" name="email" id="email" placeholder="Your Email"/>

    <textarea name="message" id="message"  placeholder="Your Message"></textarea>

    <span id="info"></span>

    <button type="submit">Submit</button>
</form>