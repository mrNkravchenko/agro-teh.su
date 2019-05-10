import Swal from 'sweetalert2';
$(document).ready(()=>{

    $('form.json').on('submit', function (e) {
        e.preventDefault();
        const self = $(this);
        const form = this;
        const button = $(self.find('button[type="submit"]'));
        const isModal = $('body').hasClass('modal-open');

        const fields = self.find('input[name], textarea[name]');
        let data = {};

        if (form.checkValidity()) {

            button.loader('on');

            _.forEach(fields, (elem)=>{
                const name = $(elem).attr('name');
                const value = $(elem).val();
                data[name] = value;
            });

            const Api = new SendApi({
                method:'post',
                dataType: 'json',
                data: data,
                url: '/callback',
                success: (answer)=>{
                    button.loader('off');


                    if (answer.status) {
                        Swal.fire({
                            type: 'success',
                            title: 'Ваше сообщение отправлено',
                            text: 'Мы с Вами свяжемся в ближайшее время',
                            confirmButtonText: 'Закрыть'
                        });
                        $(form).removeClass('was-validated');
                        form.reset();

                        if (isModal) {
                            self.parents('.modal').modal('hide');
                        }

                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Ваше сообщение не отправлено',
                            text: 'Попробуте снова в ближайшее время',
                            confirmButtonText: 'Закрыть'
                        });
                    }

                },
                error: (answer) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ваше сообщение не отправлено',
                        text: 'Попробуте снова в ближайшее время',
                        confirmButtonText: 'Закрыть'
                    });
            }
            });
            Api.send();

        }

    })

});