<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Solicitud</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>

    {{-- Menú --}}
    @include('/supervisor/navbar/menu-supervisor')
    
        {{-- Formulario de Solicitud de Beca Alimenticia --}}

    <div class="contenido_formulario">

        <div class="datos_alumno-formulario">
            @foreach($alumno as $alumno)
            <div class="nombre_alumno-formulario">
                <h5>{{$alumno->Nombre}} {{$alumno->Apellido_Materno}} {{$alumno->Apellido_Paterno}}</h1>
            </div>
    
            <div class="carrera_alumno-formulario">
                <h5>{{$alumno->Carrera}}</h1>
            </div>
    
            <div class="numero-control_alumno-formulario">
                <h5>{{$alumno->Numero_de_control}}</h1>
            </div>
            
        </div>

        

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 formulario-contestado">
                    <div class="card">
                        <h2 class="card-header">Formulario de Solicitud de Beca Alimenticia</h2>
                        <div class="card-body">
                            <form action="/submit_form" method="post">
                                <div class="mb-4">
                                    
                                    <label for="scholarship_type" class="form-label">1. La beca Alimenticia que solicitas es:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_1" id="first_time" value="primera vez" required>
                                        <label class="form-check-label" for="first_time">Primera vez</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_1" id="renewal" value="renovación" required>
                                        <label class="form-check-label" for="renewal">Renovación</label>
                                    </div>
                                </div>
    
                              <!-- Pregunta 2 -->
                                <div class="mb-4">
                                    <label for="other_scholarships" class="form-label">2. ¿Cuentas actualmente con otra beca en el Tec?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_2" id="yes_other_scholarships" value="si" required>
                                        <label class="form-check-label" for="yes_other_scholarships">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_2" id="no_other_scholarships" value="no" required>
                                        <label class="form-check-label" for="no_other_scholarships">No</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta sobre las becas actuales -->
                                <div id="scholarships_details" class="mb-4" style="display:none;">
                                    <label for="scholarships_details" class="form-label">En caso de que sí, ¿con qué becas cuentas actualmente?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="respuesta_3" id="academic_effort" value="Esfuerzo académico">
                                        <label class="form-check-label" for="academic_effort">Esfuerzo académico</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="respuesta_3" id="academic_excellence" value="Excelencia académica">
                                        <label class="form-check-label" for="academic_excellence">Excelencia académica</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="respuesta_3" id="socioeconomic" value="Socio economica">
                                        <label class="form-check-label" for="socioeconomic">Socio económica</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="respuesta_3" id="federal_scholarship" value="Beca federal">
                                        <label class="form-check-label" for="federal_scholarship">Beca federal (Benito Juárez, manutención, madres solteras, etc.)</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 3 -->
                                <div class="mb-4">
                                    <label for="live_with_family" class="form-label">3. ¿Vives con tu familia?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_4" id="yes_live_with_family" value="si" required>
                                        <label class="form-check-label" for="yes_live_with_family">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_4" id="no_live_with_family" value="no" required>
                                        <label class="form-check-label" for="no_live_with_family">No</label>
                                    </div>
                                </div>
                                 <!-- Pregunta 4 -->
                                    <div class="mb-4">
                                    <label for="currently_working" class="form-label mt-3">4. ¿Trabajas Actualmente?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_5" id="yes_working" value="si" required>
                                        <label class="form-check-label" for="yes_working">Sí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_5" id="no_working" value="no" required>
                                        <label class="form-check-label" for="no_working">No</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 5 -->
                                <div class="mb-4">
                                    <label for="dependents" class="form-label">5. ¿Cuántas personas dependen del ingreso económico de los miembros de tu hogar para cubrir gastos de alimento (incluyéndote)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_6"id="1-3_dependents" value="1-3" required>
                                        <label class="form-check-label" for="1-3_dependents">1-3</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_6" id="4-5_dependents" value="4-5" required>
                                        <label class="form-check-label" for="4-5_dependents">4-5</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_6" id="6_or_more_dependents" value="6_o_mas" required>
                                        <label class="form-check-label" for="6_or_more_dependents">6 o más</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 6 -->
                                <div class="mb-4">
                                    <label for="monthly_income" class="form-label">6. ¿Cuál es el ingreso económico mensual?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_7" id="2500-3000" value="2500-3000" required>
                                        <label class="form-check-label" for="2500-3000">2500-3000</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_7" id="3000-4000" value="3000-4000" required>
                                        <label class="form-check-label" for="3000-4000">3000-4000</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_7" id="4000-5000" value="4000-5000" required>
                                        <label class="form-check-label" for="4000-5000">4000-5000</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_7" id="5000_more" value="5000 o mas" required>
                                        <label class="form-check-label" for="5000_more">5000 o más</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 7 -->
                                <div class="mb-4">
                                    <label for="responsible_person" class="form-label">7. ¿Quién es la persona responsable de cubrir tus gastos escolares y colegiaturas?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_8" id="parents" value="Padres" required>
                                        <label class="form-check-label" for="parents">Padres (ambos)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_8" id="single_parent_or_guardian" value="Mamá, Papá o tutor" required>
                                        <label class="form-check-label" for="single_parent_or_guardian">Mamá, Papá o tutor</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_8" id="myself" value="Yo mismo<" required>
                                        <label class="form-check-label" for="myself">Yo mismo</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_8" id="other_person" value="Otra persona" required>
                                        <label class="form-check-label" for="other_person">Otra persona</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 8 -->
                                <div class="mb-4">
                                    <label for="housing_situation" class="form-label">8. La vivienda donde vive tu familia es:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_9" id="own_house" value="Propia" required>
                                        <label class="form-check-label" for="own_house">Propia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_9" id="rent_house" value="Renta" required>
                                        <label class="form-check-label" for="rent_house">Renta</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_9" id="borrowed_house" value="Prestada" required>
                                        <label class="form-check-label" for="borrowed_house">Prestada</label>
                                    </div>
                                        <div class="form-check">
                                            <label class="form-check-label" for="respuesta_9">Otros</label>
                                            <textarea class="form-control" name="scholarship_reason" id="scholarship_reason" rows="3" placeholder="Escribe aquí..."></textarea>
                                    </div>
                                </div>
    
                                <!-- Pregunta 9 -->
                                <div class="mb-4">
                                    <label for="health_services" class="form-label">9. ¿Con qué servicio de salud cuentan tú y tu familia?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_10" id="imss" value="imss" required>
                                        <label class="form-check-label" for="imss">IMSS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_10" id="issste" value="issste" required>
                                        <label class="form-check-label" for="issste">ISSSTE</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_10" id="insabi" value="insabi" required>
                                        <label class="form-check-label" for="insabi">INSABI</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_10" id="major_medical_expenses" value="Gastos de servicios médicos mayores" required>
                                        <label class="form-check-label" for="major_medical_expenses">Gastos de servicios médicos mayores</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_10" id="no_health_services" value="No tengo" required>
                                        <label class="form-check-label" for="no_health_services">No tengo</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="respuesta_10">Otros</label>
                                        <textarea class="form-control" name="scholarship_reason" id="scholarship_reason" rows="3" placeholder="Escribe aquí..." ></textarea>
                                    </div>
                                    
                                </div>
    
                                <!-- Pregunta 10 -->
                                <div class="mb-4">
                                    <label for="transportation" class="form-label">10. ¿Qué medio de transporte utilizas para ir a la escuela?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="taxi" value="taxi" required>
                                        <label class="form-check-label" for="taxi">Taxi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="bus" value="Camión" required>
                                        <label class="form-check-label" for="bus">Camión</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="online_service" value="servicio_online" required>
                                        <label class="form-check-label" for="online_service">Servicio online (Uber, Didi, etc.)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="walking" value="Caminando" required>
                                        <label class="form-check-label" for="walking">Caminando</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="two_wheel_vehicle" value="Vehículo_de_2_ruedas" required>
                                        <label class="form-check-label" for="two_wheel_vehicle">Vehículo de 2 ruedas (bicis, motocicletas, otros)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_11" id="own_car" value="Carro propio" required>
                                        <label class="form-check-label" for="own_car">Carro propio</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 11 -->
                                <div class="mb-4">
                                    <label for="commute_time" class="form-label">11. ¿Cuánto tiempo tardas en trasladarte de tu casa a la escuela?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_12" id="0-14_minutes" value="0-14_min" required>
                                        <label class="form-check-label" for="0-14_minutes">0-14 min</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_12" id="15-29_minutes" value="15-29_min" required>
                                        <label class="form-check-label" for="15-29_minutes">15-29 min</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_12" id="30-59_minutes" value="30-59_min" required>
                                        <label class="form-check-label" for="30-59_minutes">30-59 min</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_12" id="60_minutes_or_more" value="60_minu_o_mas required>
                                        <label class="form-check-label" for="60_minutes_or_more">60 min o más</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 12 -->
                                <div class="mb-4">
                                    <label for="school_duration" class="form-label">12. ¿Cuánto tiempo duras en la escuela?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_13" id="4-6_hours" value="4-6_horas" required>
                                        <label class="form-check-label" for="4-6_hours">4 a 6 horas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_13" id="7-8_hours" value="7-8_horas" required>
                                        <label class="form-check-label" for="7-8_hours">7 a 8 horas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="respuesta_13" id="9_or_more_hours" value="9_o_mas_horas" required>
                                        <label class="form-check-label" for="9_or_more_hours">9 o más horas</label>
                                    </div>
                                </div>
    
                                <!-- Pregunta 13 -->
                                <div class="mb-4">
                                    <label for="scholarship_reason" class="form-label">13. Describe las causas de por qué solicitas la beca</label>
                                    <textarea class="form-control" name="respuesta_14" id="scholarship_reason" rows="3" placeholder="Escribe aquí..." required></textarea>
                                </div>
        
                            </form>

                                <div class="contenido_botones-solicitud">
                            <form method="POST" action="{{route('supervisor.aceptarSolicitud',[$alumno->alumno_id])}}">
                                @csrf
                                
                                    <div class="botones_solicitud">
    
                                        <button type="submit">

                                            <img src="{{URL::asset('/img/icons/acept.png')}}" alt="" height="50">

                                        </button>
                                            
    
                                    </div>

                            </form>

                            <form method="POST" action="{{route('supervisor.rechazarSolicitud',[$alumno->alumno_id])}}">
                                @csrf
                                <div class="botones_solicitud">

                                    <button type="submit">

                                        <img src="{{URL::asset('/img/icons/cancel.png')}}" alt="" height="50">

                                    </button>
                                        
                                    

                                </div class="botones_solicitud">

                            </form>
                                
                            <form method="POST" action="{{route('supervisor.esperaSolicitud',[$alumno->alumno_id])}}">

                                @csrf
                                <div class="botones_solicitud">

                                    <button type="submit">

                                        <img src="{{URL::asset('/img/icons/pending.png')}}" alt="" height="50">

                                    </button>
                                        
                                </div>

                            </form>

                                </div>
                            
        @endforeach                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- CDN'S de Bootstrap Js --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
        crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
        crossorigin="anonymous">
</script>

</body>
</html>