<div class="page-directions">
    <div class="row action-title col-s-12"><h1>Información General</h1></div>
    <br>
    <div class="check-info col-s-12 col-m-12 col-8 col-offset-2 no-padding">
        <form action="index.php?page=Directions" method="POST" class="{{show}}">
            <h2>Modificar Direcciones Anteriores</h2>
            <div class="direcciones col-s-12 no-margin no-padding">
                {{foreach userHood}}
                    <button class="col-s-12 col-m-2 col-3 col-l-2 mine" id="btnMia" name="btnMia" value="{{directCod}}"> {{hoodDsc}} </button>
                {{endfor userHood}}
            </div>
        </form> 
            <h2>Nueva Dirección</h2>
            <div class="line-redDark"></div> 
            <form id="form2" action="index.php?page=Directions" method="POST" class="col-offset-2 col-offset-l-1 no-padding">
                <input type="hidden" name="token" id="token" value="{{token}}">
                 <input type="hidden" name="hoodCodFK" id="hoodCodFK" value="{{hoodCodFK}}">
                <input type="hidden" name="btnConfirmar" value="confirmar">
                <div class="row">
                <label for="hoodCod">Lugar de Residencia:</label>&nbsp;<br>
                <select class="col-s-12 col-m-7 col-8 col-l-5"name="hoodCod" id="hoodCod" required>
                        {{foreach hood}}
                            <option value="{{hoodCod}}" {{selected}} >{{hoodDsc}}</option>
                        {{endfor hood}}
                </select>
                </div>
                <div class="row">
                    <label for="directStreet">Dirección Especifica:</label>
                    <br>
                    <textarea class="col-s-12 col-m-12 col-10 col-l-10 {{dErr}}"name="directStreet" id="directStreet" {{if direErr}}placeholder="{{direErr}}"{{endif direErr}} 
                            placeholder="Ej. Esquina Opuesta al mall premier, tercer casa color roja despues de la pulperia 'Alicia'." required>{{directStreet}}</textarea>
                </div>
                
                <button class="button-3 col-s-8 col-m-2 col-3 col-l-2 col-offset-s-2 col-offset-m-9 col-offset-6 col-offset-l-7" type="submit" id="btnConfirmar" name="btnConfirmar">Confirmar</button>
        </form>
    </div>
</div>
<script>
    $().ready(function(e){
        $("#btnShow").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $("#form2").toggleClass('hidden');
        $("#btnShow").toggleClass('hidden');
        });
        
    });
</script> 