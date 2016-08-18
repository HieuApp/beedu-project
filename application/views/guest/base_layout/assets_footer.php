
<script src="<?php echo base_url("assets/js/material_js/jquery-2.1.1.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/material_js/materialize.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/material_js/init.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery-3.1.0.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/index.js"); ?>"></script>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1798369220409564',
            xfbml      : true,
            version    : 'v2.7'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

