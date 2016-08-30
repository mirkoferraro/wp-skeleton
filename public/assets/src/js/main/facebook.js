//=require ../lib/facebook-sdk.js

var
appId     = '1711609099057129',
appSecret = '68b88b9d3a72711ab5f7faba3c59f893',
token;

window.fbAsyncInit = function() {
    FB.init({
        appId:   appId,
        xfbml:   true,
        version: 'v2.5'
    });

    var token = FB.getAccessToken();

    jQuery.get('https://graph.facebook.com/oauth/access_token?client_id='+appId+'&client_secret='+appSecret+'&grant_type=client_credentials', function(dataToken) {
        token = dataToken;
    });
};
