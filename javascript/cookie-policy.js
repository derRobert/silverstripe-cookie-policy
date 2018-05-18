window.addEventListener('load', function() {
    document.getElementById("cookie-policy-banner-accept").addEventListener("click", function(){
        var date = new Date();
        date.setTime(date.getTime() + 31536000000); // 365 days in ms
        document.cookie = 'CookiePolicyAccepted' + '=1;expires=' + date.toGMTString() + ';path=/';
        var elem = document.getElementById("cookie-policy-banner");
        elem.parentNode.removeChild(elem);
    });
});
