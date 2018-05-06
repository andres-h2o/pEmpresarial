<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="col-md-4 control-label">{{ 'Nombre' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nombre" type="text" id="nombre" value="{{ $volumetrico->nombre or ''}}" >
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('a') ? 'has-error' : ''}}">
    <label for="a" class="col-md-4 control-label">{{ 'A' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="a" type="number" id="a" value="{{ $volumetrico->a or ''}}" >
        {!! $errors->first('a', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('b') ? 'has-error' : ''}}">
    <label for="b" class="col-md-4 control-label">{{ 'B' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="b" type="number" id="b" value="{{ $volumetrico->b or ''}}" >
        {!! $errors->first('b', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('h') ? 'has-error' : ''}}">
    <label for="h" class="col-md-4 control-label">{{ 'H' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="h" type="number" id="h" value="{{ $volumetrico->h or ''}}" >
        {!! $errors->first('h', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('o') ? 'has-error' : ''}}">
    <label for="o" class="col-md-4 control-label">{{ 'O' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="o" type="number" id="o" value="{{ $volumetrico->o or ''}}" >
        {!! $errors->first('o', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('swc') ? 'has-error' : ''}}">
    <label for="swc" class="col-md-4 control-label">{{ 'Swc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="swc" type="number" id="swc" value="{{ $volumetrico->swc or ''}}" >
        {!! $errors->first('swc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gop') ? 'has-error' : ''}}">
    <label for="gop" class="col-md-4 control-label">{{ 'Gop' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="gop" type="number" id="gop" value="{{ $volumetrico->gop or ''}}" >
        {!! $errors->first('gop', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('g') ? 'has-error' : ''}}">
    <label for="g" class="col-md-4 control-label">{{ 'G' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="g" type="number" id="g" value="{{ $volumetrico->g or ''}}" >
        {!! $errors->first('g', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
