$(document).ready(function() {
    $('#show-password').click(function(event) {
        if ($('#password').attr('type') == 'password') {
            $('#show-password').removeClass('fa fa-eye fa-3 text-info text-success');
            $('#show-password').addClass('fa fa-eye-slash fa-3 text-danger');
            $('#password').attr('type', 'text');
        } else{
            $('#show-password').removeClass('fa fa-eye-slash fa-3 text-danger');
            $('#show-password').addClass('fa fa-eye fa-3 text-success');
            $('#password').attr('type', 'password');
        };
    });
});