import Swal from 'sweetalert2';
const CYRILLIC_PATTERN = /[\u0400-\u04FF\d\s.\!\?\"\№\%\:\,\.\;\(\)]+$/gi;
$(document).ready(()=>{

    $('#feedbacks #form_name, #feedbacks #form_title').on('keyup change', function (e) {
        const target = $(e.target);
        const errorClass = '#' + target.attr('id') + '_error';
        const submitButton = $('#feedbacks form button[type="submit"]');
        if (!target.val().match(CYRILLIC_PATTERN) && target.val() != '') {
            $(errorClass).css('display', 'block');
            submitButton.attr('disabled', true);
        } else {
            $(errorClass).css('display', 'none');
            submitButton.removeAttr('disabled');
        }
    });

    $('#feedbacks form').on('submit', function (e) {
        e.preventDefault();
        const self = $(this);
        const form = this;
        const button = $(self.find('button[type="submit"]'));
        const isModal = $('body').hasClass('modal-open');
        const name = $('#form_name').val();
        const title = $('#form_title').val();

        if (!name.match(CYRILLIC_PATTERN)) {
            $('#form_name_error').css('display', 'block');
            return false;
        } else {
            $('#form_name_error').css('display', 'none');
        }

        if (!title.match(CYRILLIC_PATTERN)) {
            $('#form_title_error').css('display', 'block');
            return false;
        } else {
            $('#form_title_error').css('display', 'none');
        }

        button.loader('off');


        if (form.checkValidity()) {

            button.loader('on');


            let userVerifed = false;

            grecaptcha.execute('6LfUvKEUAAAAAE69avndcaHZP0OD55IeOYOanmaA', {action: 'social'})
                .then(function(token) {
                    const veryfyApi = new SendApi({
                        method:'post',
                        dataType: 'json',
                        data: {token:token},
                        url: '/verify-user',
                        success: (answer)=>{
                            if (answer.status) {
                                form.submit();

                            } else {
                                button.loader('off');
                                Swal.fire({
                                    type: 'error',
                                    title: 'Ваше сообщение не отправлено',
                                    text: 'Система определила Вас как робота',
                                    confirmButtonText: 'Закрыть'
                                });
                            }
                        },
                        error: (answer) => {
                            button.loader('off');
                        }
                    });
                    veryfyApi.send();
                });
        }

    })

});