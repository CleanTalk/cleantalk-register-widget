(function($, options) {

    const sendForm = (e) => {
        e.preventDefault();
        $('#submit_btn').attr('disabled', 'disabled');
        $('#help_hint').hide().text('').removeClass('success').removeClass('error');
        let data = $(e.target).serialize();
        $.ajax({
            type: 'POST',
            url: options.ajaxUrl,
            data: data,
            success: (data) => { sendFormSuccess(data) },
            error: () => { sendFormError() }
        });
    }

    const sendFormSuccess = (data) => {
        const answerClass = data.success ? 'success' : 'error';
        let answerBlock = $('#help_hint');
        answerBlock.addClass(answerClass);
        answerBlock.text(data.data);
        answerBlock.show();
        $('#submit_btn').removeAttr('disabled');
    }

    const sendFormError = () => {
        let answerBlock = $('#help_hint');
        answerBlock.addClass('error');
        answerBlock.text('Error!');
        answerBlock.show();
        $('#submit_btn').removeAttr('disabled');
    }

    const addListeners = () => {
        $('.cleantalk_register_widget #reg').on('submit', (e) => sendForm(e));
    }

    $(document).ready(addListeners);

})(jQuery, ctRegWidgetOptions);