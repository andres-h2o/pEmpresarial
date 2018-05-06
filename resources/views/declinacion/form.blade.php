<div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    <label for="fecha" class="col-md-4 control-label">{{ 'Fecha' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="fecha" type="date" id="fecha" value="{{ $declinacion->fecha or ''}}" >
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('v1') ? 'has-error' : ''}}">
    <label for="v1" class="col-md-4 control-label">{{ 'V1' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="v1" type="number" id="v1" value="{{ $declinacion->v1 or ''}}" >
        {!! $errors->first('v1', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('v2') ? 'has-error' : ''}}">
    <label for="v2" class="col-md-4 control-label">{{ 'V2' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="v2" type="number" id="v2" value="{{ $declinacion->v2 or ''}}" >
        {!! $errors->first('v2', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('v3') ? 'has-error' : ''}}">
    <label for="v3" class="col-md-4 control-label">{{ 'V3' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="v3" type="number" id="v3" value="{{ $declinacion->v3 or ''}}" >
        {!! $errors->first('v3', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
