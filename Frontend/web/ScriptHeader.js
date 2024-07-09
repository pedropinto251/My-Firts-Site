$(document).ready(function() {

        $.ajax({
            url: "../../Ajax/AjaxSession.php",
            success: function(response) {

                switch(response) {
                    case "semLogin":
                        $(".option-login-buttons").show(); 
                        $(".option-logout").css("display", "none");
                        $(".option-reserved-area").css("display", "none");
                        break;
                    case "comLogin":
                        $(".option-login-buttons").css("display", "none");
                        $(".option-reserved-area").show();
                        $(".option-logout").show();                  
                        break;
                }                
            }           
        });        
});

    function logout(){
        $.ajax({
            url: "../../../common/Logout.php",
            success: function() {

                $(".option-login-buttons").show();
                $(".option-logout").css("display", "none");
                $(".option-reserved-area").css("display", "none");
           
            }                        
        });
    }