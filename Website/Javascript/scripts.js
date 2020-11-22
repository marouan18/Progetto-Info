function EsciDallaPagina() {
    var modal = document.getElementById('id01');
    modal.style.display = 'block';
    window.onclick = function(event) {
        if (event.target == modal) {
            window.history.back();
        }
    }
}

function ButtonCLck() {
    alert("ciaoooo");
}
/*
   
   
        $(document).ready(function() {
            $('.button').click(function() {
                var clickBtnValue = $(this).val();
                var ajaxurl = 'ajax.php',
                    data = { 'action': clickBtnValue };
                $.post(ajaxurl, data, function(response) {
                    // Response div goes here.
                    alert("action performed successfully");
                });
            });
        });
    } else {
        alert("inserre un valore valido");
    }*/