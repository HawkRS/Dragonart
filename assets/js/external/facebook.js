window.fbAsyncInit = function() {
    FB.init({
        appId      : '1744902582421509',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.6'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/es_ES/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function ingresarFacebook() {  
    FB.login(function(response){  
        validarUsuario();  
    }, {scope: 'public_profile, email'});  
}

function validarUsuario() {  
    FB.getLoginStatus(function(response) {  
        if(response.status == 'connected') {
            FB.api('/me?fields=id,name,email', function(response) {
                console.log(JSON.stringify(response));
                alert('Hola ' + response.email);
            });   
        } else if(response.status == 'not_authorized') {  
            alert('Debes de dar permisos a DragonArt para el manejo de tu información');  
        } else {  
            alert('Debes de iniciar sesión en Facebook');  
        }  
    });  
}  