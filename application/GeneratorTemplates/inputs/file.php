<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="{{inputName}}">{{label}}</label> {{requiredInfo}}
                <input type="file" class="form-control" id="{{inputName}}" name="{{inputName}}" placeholder="Entrada {{label}}">
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <img id="{{inputName}}ImagePreview" class="factoryLogo" src="<?php echo URL; ?>uploads/default/preview.png" alt="{{inputName}}" class="img-thumbnail">
            </div>
        </div>
    </div>
</div>