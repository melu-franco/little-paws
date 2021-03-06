<div class="sidebar hidden-sm">
    <div>
        <h3 class="sidebar__title title title--small -mayus">
            Menu
        </h3>
        <ul class="sidebar__ul">
            <li><a class="d-flex flex-ai-center" href="/home"><i class="material-icons">home</i> Inicio</a></li>
            <li><a class="d-flex flex-ai-center" href="/profile/{{Auth::user()->id}}"><i class="material-icons">person</i> Perfil</a></li>
            <li><a class="d-flex flex-ai-center" href="{{ route('users') }}"><i class="material-icons">people</i> Usuarios</a></li>
        </ul>

    </div>

    <div>
        <h3 class="sidebar__title title--small -mayus">
            Links de interés
        </h3>
        <ul class="sidebar__ul">
            <li><a class="d-flex flex-ai-center" href="https://www.buenosaires.gob.ar/mascotas/atenciones-veterinarias-gratuitas" target="_blank">Castraciones y atenciones clínicas gratuitas</a></li>
            <li><a class="d-flex flex-ai-center" href="" target="_blank">Guarderias caninas</a></li>
            <li><a class="d-flex flex-ai-center" href="https://www.patitapatita.com/" target="_blank">Adiestramiento de perros y gatos</a></li>
            <li><a class="d-flex flex-ai-center" href="" target="_blank"></a></li>
            <li><a class="d-flex flex-ai-center" href="https://www.boardingpet.com.ar/?gclid=EAIaIQobChMI4ffInNbX4AIVEIGRCh0dSQaIEAAYASAAEgKPV_D_BwE" target="_blank">Viajes con tu mascota</a></li>
        </ul>
    </div>
</div>
