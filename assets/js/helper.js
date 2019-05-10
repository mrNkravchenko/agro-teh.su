window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}, false);

$.fn.loader = function(state){
    const spinner = $(this).find('span.spinner-border');
    const text = $(this).find('span[data-type="title"]');


    switch (state) {
        case 'on':
            $(this).prop('disabled', true);
            text.text(text.data('request'));
            spinner.removeAttr('hidden');
            break;
        case 'off':
            $(this).removeAttr('disabled');
            text.text(text.data('ready'));
            spinner.prop('hidden', true);
            break;

    }

};


class SendApi {
    constructor(options = {method:'post', dataType: 'json', data: {}, url: '', success: '', error: ''}){
        this.method = options.method;
        this.dataType = options.dataType;
        this.data = options.data;
        this.url = options.url;
        this.onsuccess = options.success;
        this.error = options.error;
        this.self = this;
    }

    isFunction(functionToCheck){
        return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
    };


    send(){
        $.ajax({
            url: this.url,
            method: this.method,
            dataType: this.dataType,
            data: this.data,
            success:  (answer) => {

                if (this.isFunction(this.onsuccess)) {
                    this.onsuccess(answer);
                }

            },
            error: (answer) => {

                if (isFunction(self.error)) {
                    self.error(answer);
                }

            }

        });
    }
}

window.SendApi = SendApi;

