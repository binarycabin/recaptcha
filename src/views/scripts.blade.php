<script src="https://www.google.com/recaptcha/api.js?render={{ $siteKey }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ $siteKey }}', {action: 'homepage'}).then(function(token) {
            let inputElement = document.getElementById("recaptcha-token-input");
            if(inputElement){
                inputElement.value = token;
            }
        });
    });
</script>