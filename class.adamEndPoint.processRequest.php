<?php


class processRequest {
    //display the response in a table and a pop up modal
	public static function process($data){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/css/uikit.min.css" />
        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.7/dist/js/uikit-icons.min.js"></script> 
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Display Table</title>
    </head>
    <body>
	<div class="uk-overflow-auto">
	<table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>UserName</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach( $data as $users ) {
            $id = $users->id; 
            $name = $users->name; 
            $username = $users->username; 
            $email = $users->email; 
        ?>     
        <tr>
            <!-- Modal popup -->
            <div class="modal fade modal-lg" id="details_modal_<?php echo esc_attr($id) ?>" role="dialog">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="header uk-align-center">More Information</h3>
                    </div>
                    <div class="modal-body">
                        <div class="display_details" id="<?php echo 'display_details_' . esc_attr($id) ?>"></div>  
                    </div> 
                </div>
            </div>

             <td class="additional-details">
                <a href="#" id="<?php echo $id ?>"><?php echo esc_html($id) ?></ap>
            </td>
            <td class="additional-details">
                <a href="#" id="<?php echo $id ?>"><?php echo esc_html($name) ?></a>
            </td>
            <td class="additional-details">
                <a href="#" id="<?php echo $id ?>"><?php echo esc_html($username) ?></a>
            </td>
            <td class="additional-details">
                <a href="#" id="<?php echo $id ?>"><?php echo esc_html($email) ?></a>
            </td>
        </tr>
      <?php } ?>

    </tbody>
</table>
</div>
</body>
</html>
<!-- Add additional styling for modal and table -->
<style>
.header{
	color:#fff;
}
td.additional-details {
    font-weight: 400;
}
.uk-link, a {
    color: #000 !important;
}

.uk-table th {
    text-align: center !important;
    font-size: 1.0rem !important;
    color: #000 !important;
}
.display_details {
    font-size: 14px;
    font-weight: 400;
}
.modal-header {
    padding: 0 !important;
}
.modal-lg {
    width: 100% !important;
}

.modal-content {
    border: none !important;
}

.modal-header {
    background-color: #000;
	color:#fff;
}

.modal-backdrop {
    /* bug fix - no overlay */    
    display: none;    
}

.modal-content {
    margin-top: 10rem;
    text-align: center;
}

.modal.fade.in .modal-content .close {
      font-size: 30px;
      color: #fff;
      opacity: 0.9; 
}
.uk-table td {
    text-align: center !important;
}
</style>

<!-- Add jquery for modal-->
<script>
    jQuery(document).ready(function () {
    jQuery('.additional-details a').click(function(){
        event.preventDefault();
        var id = jQuery(this).attr('id');

        // Cors Header for proxy header
        jQuery.ajaxPrefilter( function (options) {
            if (options.crossDomain && jQuery.support.cors) {
              var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
              options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
            }
          });
        
        jQuery.ajax({
            url: 'https://jsonplaceholder.typicode.com/users/', //API url
            type: "GET",
            dataType:'json', 
            
            success: function(data) {
                // Parse Json response into modal body
                var responseID = id - 1; 
                jQuery('.display_details').empty();
                jQuery('#details_modal_'+ id).modal('toggle');

                jQuery('#display_details_' + id).append('Company Name:' + data[responseID]['company']['name'] + "<br />");
                jQuery('#display_details_' + id).append('Slogan: ' + data[responseID]['company']['catchPhrase'] + "<br />");
                jQuery('#display_details_' + id).append('Company Speciality: ' + data[responseID]['company']['bs'] + "<br />");
                jQuery('#display_details_' + id).append('Phone Number: ' + data[responseID]['phone'] + "<br />");
                jQuery('#display_details_' + id).append('Website: ' + data[responseID]['website'] + "<br />");
                jQuery('#display_details_' + id).append('Street Address: ' + data[responseID]['address']['street'] + "<br />");
                jQuery('#display_details_' + id).append('Suite: ' + data[responseID]['address']['suite'] + "<br />");
                jQuery('#display_details_' + id).append('City: ' + data[responseID]['address']['city'] + "<br />");
                jQuery('#display_details_' + id).append('Zipcode: ' + data[responseID]['address']['zipcode'] + "<br />");
                jQuery('#display_details_' + id).append('Latitude: ' + data[responseID]['address']['geo']['lat'] + "<br />");
                jQuery('#display_details_' + id).append('Longitude: ' + data[responseID]['address']['geo']['lng']);
             },
             error: function() {
                 console.log('Error occured');
             }
        })    
    });
});
</script>

<?php }

}	