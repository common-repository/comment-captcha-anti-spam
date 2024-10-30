// Include the random string file for captcha
jQuery(document).ready(function() {

    function generateUUID() {
        var d = new Date().getTime();
        var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
        return uuid;
    }
    ;
// Change CAPTCHA on each click or on refreshing page.
    jQuery("#reload").click(function() {
        jQuery("#im").remove();
        jQuery('<img id="im" src="' + captcha.url + 'image.php?rand=' + generateUUID() + '"/>').appendTo("#imgdiv");

    });

});
