$(document).ready(function() {

    $('.select-multiple').select2({
        theme: 'bootstrap-5',
        placeholder: $( this ).data( 'placeholder' ),
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        closeOnSelect: false,
        allowClear: false,
    });

    function toggleFloating(el) {
        let container = $(el).closest('.form-floating');

        if ($(el).val() && $(el).val().length > 0) {
            container.addClass('has-value');
        } else {
            container.removeClass('has-value');
        }
    }

    $('.select-multiple').on('change', function(){
        toggleFloating(this);
    });

    $('.select-multiple').on('select2:open', function(){
        $(this).closest('.form-floating').addClass('has-value');
    });

    $('.select-multiple').on('select2:close', function(){
        toggleFloating(this);
    });

    $('.select-multiple').each(function(){
        toggleFloating(this);
    });
});

$(document).on('click', '.delete-item', function (e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this item ?')) {
        $('#delete-form')
            .attr('action', $(this).data('url'))
            .submit();
    }
});

$(document).on('click', '.sign-out', function (e) {
    e.preventDefault();
    $('#sign-out')
        .attr('action', $(this).data('url'))
        .submit();
});


function envCallback(target) {

    var data = genObjectFromData(target.data());

    if (data.url === undefined) {
        getAlert('error', 'Error for request');
        return;
    }

    let dtID = target.data('dt-id');

    $.ajax(data.url, {
        type: 'post',
        data: data,
        success: function (data) {
            getAlert(data.status, data.message);
            if ($.fn.DataTable.isDataTable('#' + dtID)) {
                $('#' + dtID).DataTable().draw();
            }
        },
        error: function (xhr) {
            getAlert('error', 'An error occurred while performing an action.');
        }
    });

}

function getAlert(success, msg) {
    const alert = $('#alert');
    alert.attr('hidden', 'hidden')
        .removeClass('alert-danger')
        .removeClass('alert-warning')
        .removeClass('alert-success');

    let alertClass = 'alert-success';
    if (success === false || success === 'error') {
        alertClass = 'alert-danger';
    }

    if (success === 'warning') {
        alertClass = 'alert-warning'
    }

    alert.attr('hidden', false)
        .addClass(alertClass)
        .find('#alert-text')
        .text(msg);
}

function envAction(el) {
    const message = $(el).data('confirm');

    if (message) {
        if (!confirm(message)) {
            return;
        }
    }

    envCallback($(el))
}

function setDataForModal(dataObj) {
    $.each(dataObj, function (key, value) {
        $('#' + key).val(value);
    });
}

function genObjectFromData(obj) {
    const data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
    };
    $.each(obj, function (key, value) {
        data[key] = value;
    });

    return data;
}

function genModal(el, modalId) {
    const data = genObjectFromData($(el).data())

    if (data.url === undefined) {
        getAlert('error', 'Not link for modal');
        return;
    }

    $.ajax(data.url, {
        type: 'post',
        data: data,
        success: function (res) {
            if (!res.success) {
                $(modalId).modal('hide');
                getAlert('error', 'Error get modal content');
                return;
            }
            var classModal = modalId.replace('#', '.')
            $(classModal).html(res.data.modal);
            $(modalId).modal('show');
        },
        error: function (xhr) {
            $(modalId).modal('hide');
            getAlert('error', 'An error occurred while performing an action.');
        }
    });
}

function confirmModal(el, modalId = '#confirmAction') {
    const data = genObjectFromData($(el).data())

    if (data.url === undefined) {
        getAlert('error', 'Not link for confirm');
        return;
    }

    $('#formConfirmAction').attr('action', data.url);

    if (data.confirm_text !== undefined) {
        $('.confirmText').html(data.confirm_text)
    }

    $(modalId).modal('show');
}

function modalSubmit(el, formID, refreshTable = '') {
    const form = $('#' + formID);
    const formData = form.serialize();
    const url = form.attr('action');

    $.ajax(url, {
        type: 'post',
        data: formData,
        success: function (res) {
            var successClass = res.success ? 'ok' : 'error';
            getAlert(successClass, res.message);
            closeModal();

            if (refreshTable !== '' && $.fn.DataTable.isDataTable('#' + refreshTable)) {
                $('#' + refreshTable).DataTable().draw();
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                validationHandler(formID, xhr.responseJSON.errors)
                return;
            }
            closeModal();
            getAlert('error', 'Error response');
        }
    });
}

function closeModal() {
    $('.modal.show').each(function () {
        bootstrap.Modal.getInstance(this).hide();
    });
}

function validationHandler(formId, objErrors) {
    clearValidation(formId)

    $.each(objErrors, function (key, value) {
        var field = $('#' + key);
        setValidationError(field, value[0]);
    });
}

function setValidationError(selector, message) {
    let input = $(selector);
    input.addClass('is-invalid');

    if (input.next('.invalid-feedback').length === 0) {
        input.after('<div class="invalid-feedback">' + message + '</div>');
    }
}

function clearValidation(formSelector) {
    const form = $('#' + formSelector);
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove();
}

