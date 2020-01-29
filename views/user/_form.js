$('#user-username').keyup( function() {
    this.value = this.value.toLowerCase();
})

$('#user-is_ecoll').on('click', function(){
    if ($(this).is(":checked")) {
        $('#user-is_p2p').prop('checked', 'checked');
        $('#user-is_p2p').prop('disabled', true);
        $('input[name="User[is_p2p]"]').val(1);
        $('.field-multiple-select').css('display','block');  
    } else {
        $('#user-is_p2p').prop('checked', false);
        $('#user-is_p2p').prop('disabled', false);
        $('.field-multiple-select').css('display','none');
        $("#multiple-select").val({}).trigger('change');
    }
});

$('#user-is_p2p').on('click', function() {
    if ($(this).is(":checked")) {
        $('.field-multiple-select').css('display','block');            
    } else {
        $('.field-multiple-select').css('display','none');
        $("#multiple-select").val({}).trigger('change');
    }
});

if ($('#user-is_ecoll').is(":checked")) {
    $('#user-is_p2p').prop('checked', true);
    $('#user-is_p2p').prop('disabled', true);
    $('input[name="User[is_p2p]"]').val(1);
    $('.field-multiple-select').css('display','block');
}

if ($('#user-is_p2p').is(":checked")) {
    $('.field-multiple-select').css('display','block'); 
}

$('#multiple-select').select2({});
$('span.select2').css({"width" : "100%", "max-width" : "612px"});
$('span.select2-selection--multiple').css('border-color', '#cecece');
$('#multiple-select').val(_opts).trigger('change');