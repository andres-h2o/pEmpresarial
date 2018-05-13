<div class="form-group {{ $errors->has('Pozo') ? 'has-error' : ''}}">
    <label for="Pozo" class="col-md-4 control-label">{{ 'Pozo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Pozo" type="text" id="Pozo" value="{{ $pozo->Pozo or ''}}" >
        {!! $errors->first('Pozo', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        {!! Form::label(' ',null,['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <button type="button" class="btn btn-primary btn-lg btn-block" id="btnUbicacion">
                Capturar  Ubicación
            </button>
            <div class="col-md-6" id="map" style="width: 100%;height: 40%  ;"></div>
            <input type="numbre" class="form-control" step="any" style="display: none" id="inLat" name="x">
            <input type="numbre" class="form-control" step="any" style="display: none"id="inLon" name="y">
        </div>
    </div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
