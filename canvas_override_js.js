function openWin()
{

	 $.ajax({
      url: "/logout",
      type: "POST",
      async:false,
      success: function(){
         success = true
      }
    });
    if(success){ //AND THIS CHANGED
     window.open("http://beta.thecompellingimage.com/wp-login.php?action=logout","_self")
    }

}