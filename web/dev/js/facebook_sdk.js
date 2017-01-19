FB.init({
    appId      : '{your-app-id}',
    status     : true,
    xfbml      : true,
    version    : 'v2.7' // or v2.6, v2.5, v2.4, v2.3
});
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));