jQuery(document).ready(function($) {
    var mediaUploader;

    $('#uploadSunsetProPic').on('click', function(e) {
        e.preventDefault();
        if(mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#sunsetProPic').val(attachment.url);
            $('#sunsetProPicPrev').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();
    });

    $('#removeSunsetProPic').on('click', function(e) {
        e.preventDefault();

        var answer = confirm("Are you sure you want to remove your Profile Picture?");

        if(answer == true) {
            $('#sunsetProPic').val('');
            $('.sunsetAdminGeneralForm').submit();
        }
    });
});