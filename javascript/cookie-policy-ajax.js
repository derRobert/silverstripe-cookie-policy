if( ! document.cookie.match(/^(.*;)?\s*CookiePolicyAccepted\s*=\s*[^;]+(.*)?$/)  ) {
    var request = new XMLHttpRequest();
    request.open("GET","/cookie-policy-control/");
    request.addEventListener('load', function(event) {
        if (request.status >= 200 && request.status < 300) {
            var c = document.createElement('div');
            c.innerHTML = request.responseText;
            document.body.appendChild(c);
            document.getElementById("cookie-policy-banner-accept").addEventListener("click", function () {
                var date = new Date();
                date.setTime(date.getTime() + 31536000000); // 365 days in ms
                document.cookie = 'CookiePolicyAccepted' + '=1;expires=' + date.toGMTString() + ';path=/';
                var elem = document.getElementById("cookie-policy-banner");
                elem.parentNode.removeChild(elem);
            });
        } else {
            console.warn(request.statusText, request.responseText);
        }
    });
    request.send();
}
