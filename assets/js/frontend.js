(function($) {

    const sendForm = (e) => {
        e.preventDefault();
        $('#submit_btn').attr('disabled', 'disabled');
        const data = $(e.target).serialize();
        $.ajax({
            type: 'POST',
            url: 'https://api.cleantalk.org',
            data: data,
            success: () => { sendFormSuccess() },
            error: () => { sendFormError() }
        });
    }

    const sendFormSuccess = () => {
        let answerBlock = $('#help_hint');
        answerBlock.addClass('success');
        answerBlock.text('Success!');
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

})(jQuery);