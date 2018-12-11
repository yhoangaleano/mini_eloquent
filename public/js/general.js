function getDataFromForm(formName) {

    var fd = new FormData();
    var files = $('#' + formName).find('input[type="file"]');

    if (files.length > 0) {

        var size_fields = files.length;

        for (let j = 0; j < size_fields; j++) {

            var file_data = files[j].files;
            var size_files = file_data.length;
            var fieldName = $(files[j]).attr("id");
            fieldName += size_files > 1 ? "[]" : "";

            for (var i = 0; i < size_files; i++) {
                fd.append(fieldName, file_data[i]);
            }
        }
    }

    var other_data = $('#' + formName).serializeArray();
    $.each(other_data, function (key, input) {
        fd.append(input.name, input.value);
    });

    return fd;
}

function validImage(field) {

    var self = field;

    var size = self.files.length;
    for (let index = 0; index < size; index++) {
        var file = self.files[index];
        var imagefile = file.type;
        var match = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alert('Por favor selecciona una imagen valida (JPEG/JPG/PNG/GIF).');
            $(self).val("");
            return false;
        }
    };
}

function redirect(url) {
    var ua = navigator.userAgent.toLowerCase(),
        isIE = ua.indexOf('msie') !== -1,
        version = parseInt(ua.substr(4, 2), 10);

    // Internet Explorer 8 and lower
    if (isIE && version < 9) {
        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();
    }

    // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like Internet Explorer 8 & lower does)
    else {
        window.location.href = url;
    }
}

function showSpinner() {
    $("#spinner").removeClass('hide').addClass('show');
}

function hideSpinner() {
    $("#spinner").removeClass('show').addClass('hide');
}

function showPanelError(errors, title = "Verificar información") {

    $("#panelError").removeClass('hide').addClass('show');
    $("#panelErrorTitle").append(title);

    var errorMessages = '';

    errors['fields'].forEach(element => {
        errors[element].forEach(error => {
            errorMessages += error;
            errorMessages += '<br>';
        });
    });

    $("#panelErrorErrors").append(errorMessages);
}


function showPanelErrorSimple(errors, title = "Verificar información") {

    $("#panelError").removeClass('hide').addClass('show');
    $("#panelErrorTitle").append(title);
    $("#panelErrorErrors").append(errors);
}

function hidePanelError() {
    $("#panelError").removeClass('show').addClass('hide');
    $("#panelErrorTitle").empty();
    $("#panelErrorErrors").empty();
}

function showPanelInfoSimple(errors, title = "Verificar información") {

    $("#panelInfo").removeClass('hide').addClass('show');
    $("#panelInfoTitle").append(title);
    $("#panelInfoErrors").append(errors);
}

function hidePanelInfo() {
    $("#panelInfo").removeClass('show').addClass('hide');
    $("#panelInfoTitle").empty();
    $("#panelInfoErrors").empty();
}

function scrollTopAnimate() {
    var body = $("html, body");
    body.stop().animate({ scrollTop: 0 }, 500, 'swing', function () {
    });
}

function validImage(field) {

    var self = field;

    var size = self.files.length;
    for (let index = 0; index < size; index++) {
        var file = self.files[index];
        var imagefile = file.type;
        var match = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alertify.error('Por favor selecciona una imagen valida (JPEG/JPG/PNG/GIF).');
            $(self).val("");
            return false;
        }
    };

    return true;
}

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('#imagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}