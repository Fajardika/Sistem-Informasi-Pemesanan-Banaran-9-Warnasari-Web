<!-- Script JS Search-->
<script>
    $("#pencarian").on("keyup", function(){
      $("section").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf($("#pencarian").val().toLowerCase()) > -1);
      });
    });
</script>