/**
 * Created by alexandr on 30.06.17.
 */

var id = $('.active').attr('#id');

$('.active').on('click', function () {
    $.ajax({
        url: '/bus/active/',
        data: {id: this.id},
        type: 'POST',
        success: function (res) {
            console.log(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});