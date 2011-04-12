/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#oosbl_submit').click(function() {
        var oosbl = $("#oosbl").val();
        var length = $("#songlength").val();
        var output = $("#oosbl_output");

        if ( length == "" )
        {
            alert("Please Insert a Songlength first");
            return false;
        }

        $.post("parser.php", {oosbl: oosbl, songlength: length},
        function(data) {
            output.slideUp('slow', function() {
                output.html(data);
                output.slideDown('slow');
            });

        });

    });
});