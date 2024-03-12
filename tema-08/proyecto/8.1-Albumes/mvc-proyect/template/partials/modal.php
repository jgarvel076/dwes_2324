<div id="subir" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Subir Imagen</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                    <label>Archivo</label>
                    <input type="file" class="form-control" id="archivos" name="archivo" multiple="multiple">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" name="subirArchivo">Subir Imagen</button>
            </div>
        </div>
    </div>
</div>