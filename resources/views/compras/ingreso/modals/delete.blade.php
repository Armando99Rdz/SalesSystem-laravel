

<div class="modal modal-blur fade" id="confirm-delete-{{$i -> idingreso}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">

        {!! Form::open(array(
                'action' => array('IngresoController@destroy', $i -> idingreso),
                'method' => 'delete'
                ))
        !!}
        {{Form::token()}}

        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">¿Estás seguro de continuar?</div>
                <div>Al eliminar este ingreso su total ya no será tomado en cuenta.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>
