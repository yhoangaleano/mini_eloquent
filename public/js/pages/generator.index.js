var components = {
    'input': [
        'text',
        'password',
        'number',
        'date',
        'datetime-local',
        'time',
        'email',
        'file',
        'hidden',
        'range',
        'radio',
        'checkbox'
    ],
    'select': [
        'simple',
        'multiple'
    ],
    'textarea': [
    ]
};

var validations = [
    ['required', 'Requerido'],
    ['email', 'Correo Electrónico Valido'],
    ['number', 'Número'],
    ['only_letters', 'Solo Letras'],
    ['date', 'Fecha Valida'],
    ['min', 'Mínimo (Por defecto 4 caracteres)'],
    ['max', 'Máximo (Por defecto 10 caracteres o el valor que tiene en la base de datos)'],
    ['password', 'Contraseña Fuerte'],
    ['file', 'Validación de archivo'],
    ['image', 'Validación de Imagen'],
    ['unique', 'Unico'],

];

var form = [];
var columns = [];

$(document).ready(function () {
    generator.init();
});

var generator = {

    init: function () {

        $("#formGenerator").on("submit", function (e) {
            e.preventDefault();
            hidePanelError();

            if(form.length == 0){
                alertify.error('No se ha configurado el formulario');
            }else{
                generator.generateCode();
            }
            
        });

        $('#sltTables').on('change', function () {
            var table = $(this).val();
            table = table.trim();

            if (table != '') {
                generator.getColumns(table);
            }

        });

        generator.listComponents();

        $('#sltComponente').on('change', function () {
            var component = $(this).val();
            component = component.trim();
            if(component == 'select'){
                $('#pnlSelectConfig').removeClass('hide').addClass('show');
            }else{
                $('#pnlSelectConfig').removeClass('show').addClass('hide');
            }
            generator.listComponentTypes(component);
        });

        $('#sltTipoComponente').on('change', function () {
            var typeComponent = $(this).val();
            typeComponent = typeComponent.trim();
            if(typeComponent == 'file'){
                $('#pnlFileUploadConfig').removeClass('hide').addClass('show');
            }else{
                $('#pnlFileUploadConfig').removeClass('show').addClass('hide');
            }
        });

        generator.listValidations();

        $('#sltCampo').on('change', function () {

            var isRequired = $(this).find(':selected').attr("data-required");
            var maxLength = $(this).find(':selected').attr("data-max");
            var columnType = $(this).find(':selected').attr("data-type");
            generator.addValitionToField(isRequired, maxLength, columnType);

        });

        $('#btnAgregar').on('click', function () {

            generator.addFieldInForm();
            generator.listFormTable();
            generator.clearFormBuilder();

        });

        $('#btnLimpiar').on('click', function () {
            generator.clear();
        });

        $('#pnlSelectConfig').addClass('hide');
        $('#pnlFileUploadConfig').addClass('hide');


        generator.listTables();
    },



    listTables: function () {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "generator/getTables",
            method: "GET",
            dataType: "json"
        })
            .done(function (response) {
                if (response.result == false) {

                    if (response.validationsErrors == true) {

                        alertify.error(response.message);
                        showPanelError(response.errors);

                    } else {
                        alertify.error(response.message);
                    }

                } else {
                    generator.createSelectTables(response.data);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    listComponents: function () {
        $('#sltComponente').empty();
        $('#sltComponente').append(`
            <option value=''>Seleccione un componente</option>
            <option value='input'>Input</option>
            <option value='select'>Select</option>
            <option value='textarea'>Textarea</option>
        `);
    },

    listComponentTypes: function (component) {

        if (component != '') {

            $('#sltTipoComponente').empty();

            $('#sltTipoComponente').append(`
                <option value=''>Seleccione un tipo de componente</option>
            `);

            components[component].forEach(element => {
                $('#sltTipoComponente').append(`<option value='${element}'>${element}</option>`);
            });

        }
        else {
            $('#sltTipoComponente').empty();
        }

    },

    listValidations: function () {

        $('#sltValidaciones').empty();

        validations.forEach(element => {
            $('#sltValidaciones').append(`<option value='${element[0]}'>${element[1]}</option>`);
        });

        $('#sltValidaciones').select2({
            language: "es"
        });

    },

    addValitionToField: function (isRequired, maxLength, columnType) {
        $("#sltValidaciones option:selected").prop("selected", false);

        if (isRequired == 'si')
            $("#sltValidaciones option[value='required']").prop("selected", true);

        if (columnType == 'varchar' && maxLength != 'No aplica') {
            $("#sltValidaciones option[value='min']").prop("selected", true);
            $("#sltValidaciones option[value='max']").prop("selected", true);
        }
        else if (columnType == 'int' || columnType == 'tinyint')
            $("#sltValidaciones option[value='number']").prop("selected", true);
        else if (columnType == 'date' || columnType == 'datetime')
            $("#sltValidaciones option[value='date']").prop("selected", true);

        $('#sltValidaciones').trigger('change');
    },

    createSelectTables: function (tables) {
        $('#sltTables').empty();
        $('#sltTables').append(`<option value=''>Seleccione una tabla</option>`);
        tables.forEach(element => {
            $('#sltTables').append(`<option value='${element}'>${element}</option>`);
        });
    },

    getColumns: function (table) {

        showSpinner();
        hidePanelError();

        $.ajax({
            url: url + "generator/getColumns",
            method: "POST",
            data: {
                'table': table
            },
            dataType: "json"
        })
            .done(function (response) {
                if (response.result == false) {

                    if (response.validationsErrors == true) {

                        alertify.error(response.message);
                        showPanelError(response.errors);

                    } else {
                        alertify.error(response.message);
                    }

                } else {
                    columns = response.data;
                    generator.listTableInfoColumns();
                    generator.setPrimaryKey();
                    generator.setFillablesColumns();
                    generator.listSelectColumns();
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

    listTableInfoColumns: function () {

        $('#tblInfoColumns tbody').empty();

        columns.forEach(element => {
            $('#tblInfoColumns tbody').append(`
                <tr>
                    <td>${element.Key == 'PRI' ? 'Si' : ''}</td>
                    <td>${element.Field}</td>
                    <td>${element.Type}</td>
                    <td>
                        <label class='label ${element.Null == 'YES' ? 'label-default' : 'label-success'}'>
                            ${element.Null == 'YES' ? 'No' : 'Si'}
                        </label>
                    </td>
                    <td>${element.Default}</td>
                    <td>${element.Extra}</td>

                </tr>
            `);
        });
    },

    setPrimaryKey: function(){
        var primary = columns.filter(column => column['Key'] == 'PRI');

        if(primary.length > 0){
            $('#txtPrimaryKey').val(primary[0]['Field']);
        }else{
            $('#txtPrimaryKey').val('');
        }
        
    },

    setFillablesColumns: function(){

        var other_columns = columns.filter((column) => {
            return column['Key'] != 'PRI'
                && column['Field'] != 'created_at'
                && column['Field'] != 'updated_at'
                && column['Field'] != 'deleted_at'
        });

        $('#panelFillables').empty();

        other_columns.forEach(element => {
            $('#panelFillables').append(`
                <div>
                    <input type="checkbox" class="form-check-input fillablesColumns" id='column.${element.Field}' name='fillablesColumns[]' value='${element.Field}' ${element.Null == 'YES' ? '' : 'checked'}>
                    <label style='font-weight: unset;' for="column.${element.Field}">${element.Field} (Requerido: ${element.Null == 'YES' ? 'No' : 'Si'}) </label>
                </div>
            `);
        });

    },

    listSelectColumns: function(){

        var other_columns = columns.filter((column) => {
            return column['Key'] != 'PRI'
                && column['Field'] != 'created_at'
                && column['Field'] != 'updated_at'
                && column['Field'] != 'deleted_at'
        });

        $('#sltCampo').empty();
        $('#sltCampo').append(`<option value=''>Seleccione un campo</option>`);

        other_columns.forEach(element => {

            var exist = form.filter((input) => element.Field == input.column);

            if (exist.length < 1) {

                var size = element.Type.split("(");
                var type = '';
                if (size.length > 1) {
                    type = size[0].split(")");
                    size = size[1].split(")");
                    size = size[0];
                } else {
                    type = element.Type;
                    size = 'No aplica';
                };

                $('#sltCampo').append(`<option data-required='${element.Null == 'YES' ? 'no' : 'si'}' data-type='${type}' data-max='${size}' value='${element.Field}'>${element.Field}</option>`);

            }

        });

    },

    addFieldInForm: function () {

        var field = {
            column: $('#sltCampo').val(),
            component: $('#sltComponente').val(),
            configComponentSelect: {
                uri: $('#txtURIAPI').val(),
                selectValue: $('#txtSelectValue').val(),
                selectText: $('#txtSelectText').val()
            },
            configComponentFile: {
                folder: $('#txtFolder').val()
            },
            componentType: $('#sltTipoComponente').val(),
            validations: $('#sltValidaciones').val(),
            label: $('#txtLabel').val()
        };

        console.log(field);

        form.push(field);

        generator.listSelectColumns();
    },

    clearFormBuilder: function () {
        $('#sltCampo').val('');
        $('#sltComponente').val('');
        $('#sltTipoComponente').val('');
        $('#sltValidaciones').val('');
        $('#sltValidaciones').trigger('change');
        $('#txtLabel').val('');

        $('#txtURIAPI').val();
        $('#txtSelectValue').val();
        $('#txtSelectText').val();
        $('#txtFolder').val();

        $('#pnlSelectConfig').addClass('hide');
        $('#pnlFileUploadConfig').addClass('hide');
    },

    listFormTable: function () {

        $('#tblFields tbody').empty();

        form.forEach(element => {

            var inputValidations = "";

            element.validations.map(function (element) {

                inputValidations += `
                    <label class='label label-default space-5'>
                        ${element}
                    </label>
                `;

            });

            var btnDelete = `
                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick='generator.deleteField("${element.column}")'>
                    <i class="fa fa-close"></i>
                    </button>`;

            var extra = '';
            if(element.component == 'select'){

                extra += `
                    <label class='label label-default space-5'>
                        ${element.configComponentSelect.uri}
                    </label>
                `;

                extra += `
                    <label class='label label-default space-5'>
                        ${element.configComponentSelect.selectValue}
                    </label>
                `;

                extra += `
                    <label class='label label-default space-5'>
                        ${element.configComponentSelect.selectText}
                    </label>
                `;
            }else if(element.componentType == 'file'){

                extra += `
                    <label class='label label-default space-5'>
                        ${element.configComponentFile.folder}
                    </label>
                `;

            }

            $('#tblFields tbody').append(`
                <tr>
                    <td>${element.column}</td>
                    <td>${element.component}</td>
                    <td>${element.componentType}</td>
                    <td>${inputValidations}</td>
                    <td>${element.label}</td>
                    <td>${extra}</td>
                    <td>${btnDelete}</td>
                </tr>
            `);
        });


    },

    clear: function () {
        $("#formGenerator")[0].reset();
        $('#sltValidaciones').trigger('change');
        $('#tblInfoColumns tbody').empty();
        $('#tblFields tbody').empty();
        $('#panelFillables').empty();
        $('#pnlSelectConfig').addClass('hide');
        $('#pnlFileUploadConfig').addClass('hide');
        form = [];
        columns = [];

        generator.listSelectColumns();
        generator.listComponentTypes();
    },

    deleteField: function(columnDelete){

        form = form.filter((item) => {
            return item.column != columnDelete;
        });

        generator.listFormTable();
        generator.listSelectColumns();

    },

    generateCode: function () {

        showSpinner();
        hidePanelError();

        var fillables = $('.fillablesColumns:checked').map(function(){
            return this.value;
        }).get();

        var data = {
            table: $('#sltTables').val(),
            componentName: $('#txtFileName').val(),
            primaryKey: $('#txtPrimaryKey').val(),
            labelPrimaryKey: $('#txtLabelPrimaryKey').val(),
            keyType: $('#sltKeyType').val(),
            incrementing: $('#sltIncrementing').val(),
            fillables: fillables,
            forms: form  
        }

        $.ajax({
            url: url + "generator/create",
            method: "POST",
            data: data,
            dataType: "json"
        })
            .done(function (response) {
                if (response.result == false) {

                    if (response.validationsErrors == true) {

                        alertify.error(response.message);
                        showPanelError(response.errors);

                    } else {
                        alertify.error(response.message);
                    }

                } else {
                    generator.clear();
                    alertify.success(response.message);
                }
            })
            .fail(function (error) {
                alertify.error('Ocurrió un error inesperado, por favor verifique los datos enviados o comuníquese con el administrador del sitio.')
                console.log("Oppss!! Ocurrio un error", error);
            }).always(function () {
                hideSpinner();
            });

    },

}