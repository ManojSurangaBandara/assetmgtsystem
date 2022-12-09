    function showSidebar(id)
    {
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=showSidebar&id=" + id,
            success: function(result) {
                $('#sidebar1').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar1").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
                });
            }
        });
    }
    function showSidebar2(id)
    {
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=showSidebar&id=" + id,
            success: function(result) {
                $('#sidebar2').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar2").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
                });
            }
        });

    }