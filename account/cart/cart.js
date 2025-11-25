function empty_cart() {
    var c = "Confirm cart items removal?";
    var l = '<i class="fa fa-circle-o-notch fa-spin"></i>Removing cart items ...';

    if ($('#empty_cart').text() == "Empty Cart") {
        $('#empty_cart').html(c)
        return;
    } else {
        $('#empty_cart').html(l)
    }

    $.post('clear_cart.php', {
            clear: 'yes'
        }, function(data) {
            getCartItems();
        },
        'text');
}

function cart_remove_item(id) {
    var c = "Remove item?";
    var l = '<i class="fa fa-circle-o-notch fa-spin"></i>Removing item ...';

    $.post('clear_cart.php', {
            remove: 'remove',
            id: id
        }, function(data) {
            getCartItems();
        },
        'text');
}

function checkout() {
    $.post('../transaction/checkout.php', {
            type: 'initiate_payment',
            p_type: 'multiple_items'
        }, function(data) {
            try {
                res = JSON.parse(data);

                if (res.error == 'none') {
                    //redirect to paygate
                    document.getElementById('req_id').value = res.PAY_REQUEST_ID;
                    document.getElementById('checksum').value = res.CHECKSUM;
                    document.getElementById('paygate_redirect_form').submit();
                } else {
                    alert('Action failed!');
                }
            } catch (e) {
                alert('Fatal error ' + e);
            }
        },
        'text');
}

$(document).ready(function() {
   // getCartItems();
});

function getCartItems(cancel ='') {
    $("#page_content").html("");
    $("#page_content").addClass('loading');

    $.post('page-data.php', {
            clear: 'yes',			
			cancel: cancel
        }, function(data) {
            $("#page_content").removeClass('loading');
            $("#page_content").html(data);
        },
        'text');
}