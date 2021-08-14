(function ($) {
    $(document).ready(function () {

        let selection = document.getElementsByClassName('delete');
        for(element of selection){
        element.addEventListener('click',function(e)
            {
                e.preventDefault();
                    let confirmation=confirm('Etes vous sûr de supprimer ?');
                    if(confirmation==true)
                    {
                        console.log(e.target.name);
                        $.ajax({
                            url: ajaxurl,
                            type: "POST",
                            data: {
                              'action': 'load_comments',
                              'id': e.target.name
                            }
                          }).done(function(response) {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById(e.target.name).remove()

                                }
                                };
                                 xhttp.open("POST", "admin.php?page=list_user&id="+e.target.name+"", true);
                                xhttp.send();
                          });

                    }

            }
        );
    }
    });
  })(jQuery);
