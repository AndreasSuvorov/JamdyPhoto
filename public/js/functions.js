function showNotification(title, message, type) {
    if (icontype != null) {
        jQuery.notify({

            title: title,
            message: message
        }, {
            type: type,
            delay: 3000,

        });
    } else {
        jQuery.notify({
            title: title,
            message: message
        }, {
            type: type,
            delay: 3000
        });
    }
}
