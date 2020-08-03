<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Manejo&act={{act}}&cod={{codManagement}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="codManagement" value="{{codManagement}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">

            {{ifnot insert}}
                <div class="single-input row">
                <br>
                <label class="left" for="codManagement">Codigo de Horario</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" disabled readonly="readonly" type="text" name="codManagement" 
                    id="codManagement" placeholder="Codigo de Horario" value="{{codManagement}}" {{readonly}}>
            </div>
            {{endifnot insert}}

            <div class="single-input row">
                <label for="hourStart">Inicio de Horas de Operacion</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="hourStart" id="hourStart" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach hourStart}}
                        <option value="{{hour}}" {{selected}} >{{hour}}</option>
                    {{endfor hourStart}}
                </select>
            </div>

            <div class="single-input row">
                <label for="hourEnd">Fin de Horas de Operacion</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="hourEnd" id="hourEnd" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach hourEnd}}
                        <option value="{{hour}}" {{selected}} >{{hour}}</option>
                    {{endfor hourEnd}}
                </select>
            </div>
            <div class="single-input row">
                <label class="left" for="daysManagement">Dias Activos</label><br>
                    {{foreach days}}
                         <label>
                            <input name="daysManagement[]" type="checkbox" value="{{dayCod}}" {{checked}}> {{day}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                    {{endfor days}}
            </div>
            <div class="single-input row">
                
                <label class="left" for="maxOrderManagement">Limite de Ordenes por Hora</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="maxOrderManagement" id="maxOrderManagement" 
                    placeholder="Limite de Ordenes por Hora" value="{{maxOrderManagement}}" {{maxOrderManagement}}>
            </div>
            <div class="single-buttons col-offset-s-2 col-offset-m-4 col-8 col-offset-5 no-padding">
                <button class="button-3"  type="submit" id="btnConfirmar" {{readonly}}>Confirmar</button>&nbsp;
                <button class="button-3" type="submit" id="btnCancelar">Cancelar</button>
            </div>
            <br>
        </form>
        {{if hasErrors}}
            <ul>
                {{foreach errors}}
                    <li>{{this}}</li>
                {{endofor errors}}
            </ul>
        {{endif hasErrors}}
    </div>
</div>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Manejos");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
  });
</script>