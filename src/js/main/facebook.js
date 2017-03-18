require('../lib/facebook-sdk')

var
appId     = '',
appSecret = '',
token

window.fbAsyncInit = function() {
    FB.init({
        appId:   appId,
        xfbml:   true,
        version: 'v2.5'
    })

    var token = FB.getAccessToken()

    jQuery.get('https://graph.facebook.com/oauth/access_token?client_id='+appId+'&client_secret='+appSecret+'&grant_type=client_credentials', function(dataToken) {
        token = dataToken;
    })
};
