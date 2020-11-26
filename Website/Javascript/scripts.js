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

function Tabella() {
    $('#myTable').load(function() {
        $('#myTable').dataTable();
    });
}