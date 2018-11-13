// Take the value inside the dropdown menu and
// store it inside the input.
$("#role + .dropdown-menu li a").click(function(){
    var selectedText = $(this).text();
    $("#role").val(selectedText);
});