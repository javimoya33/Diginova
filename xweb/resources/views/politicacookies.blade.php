@extends("base")

@section("titulo")
{{session("entorno")->config->x_nomemp}} - {{T::tr('Política de cookies')}}
@endsection

@section("localizador")
@endsection

@section("dashboard")
@endsection

@section("central")


<?php
$idioma=Cookie::get('idioma','1')+0;
?>
@if($idioma<=1 ||1==1)
    <h1 name="privacidad">
        {{T::tr('Política de cookies')}}
    </h1>
    <p style="text-align:justify">
    {{session("entorno")->config->x_nomemp}} informa acerca del uso de las cookies en su página web: {{str_replace("politicacookies","",URL::current())}}<br/>
    <h3>¿Qué son las cookies?</h3>
    Las cookies son archivos que se pueden descargar en su equipo a través de las páginas web.<br/>Son herramientas que tienen un papel
    esencial para la prestación de numerosos servicios de la sociedad de la información.<br/>Entre otros, permiten a una página web
    almacenar y recuperar información sobre los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información
    obtenida, se pueden utilizar para reconocer al usuario y mejorar el servicio ofrecido.<br/>
    <h3>Tipos de cookies</h3>
    Según quien sea la entidad que gestione el dominio desde donde se envían las cookies y trate los datos que se obtengan se pueden
    distinguir dos tipos:<br/>
    • Cookies propias: aquellas que se envían al equipo terminal del usuario desde un equipo o dominio gestionado
    por el propio editor y desde el que se presta el servicio solicitado por el usuario.<br/>
    • Cookies de terceros: aquellas que se envían al equipo terminal del usuario desde un equipo o dominio que no es
    gestionado por el editor, sino por otra entidad que trata los datos obtenidos través de las cookies.<br/>
    En el caso de que las cookies sean instaladas desde un equipo o dominio gestionado por el propio editor pero la información que se
    recoja mediante éstas sea gestionada por un tercero, no pueden ser consideradas como cookies propias.<br/>
    Existe también una segunda clasificación según el plazo de tiempo que permanecen almacenadas en el navegador del cliente,
    pudiendo tratarse de:<br/>
    • Cookies de sesión: diseñadas para recabar y almacenar datos mientras el usuario accede a una página web. Se
    suelen emplear para almacenar información que solo interesa conservar para la prestación del servicio
    solicitado por el usuario en una sola ocasión (p.e. una lista de productos adquiridos).<br/>
    • Cookies persistentes: los datos siguen almacenados en el terminal y pueden ser accedidos y tratados durante un
    periodo definido por el responsable de la cookie, y que puede ir de unos minutos a varios años.<br/>
    Por último, existe otra clasificación con cinco tipos de cookies según la finalidad para la que se traten los datos obtenidos:<br/>
    • Cookies técnicas: aquellas que permiten al usuario la navegación a través de una página web,
    plataforma o aplicación y la utilización de las diferentes opciones o servicios que en ella existan como, por
    ejemplo, controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso
    restringido, recordar los elementos que integran un pedido, realizar el proceso de compra de un pedido, realizar 
    la solicitud de inscripción o participación en un evento, utilizar elementos de seguridad durante la navegación,
    almacenar contenidos para la difusión de vídeos o sonido o compartir contenidos a través de redes sociales.<br/>
    • Cookies de personalización: permiten al usuario acceder al servicio con algunas características de carácter
    general predefinidas en función de una serie de criterios en el terminal del usuario como por ejemplo serian el
    idioma, el tipo de navegador a través del cual accede al servicio, la configuración regional desde donde accede al
    servicio, etc.<br/>
    • Cookies de análisis: permiten al responsable de las mismas, el seguimiento y análisis del comportamiento de los
    usuarios de los sitios web a los que están vinculadas. La información recogida mediante este tipo de cookies se
    utiliza en la medición de la actividad de los sitios web, aplicación o plataforma y para la elaboración de perfiles
    de navegación de los usuarios de dichos sitios, aplicaciones y plataformas, con el fin de introducir mejoras en
    función del análisis de los datos de uso que hacen los usuarios del servicio.<br/>
    • Cookies publicitarias: permiten la gestión, de la forma más eficaz posible, de los espacios publicitarios.<br/>
    • Cookies de publicidad comportamental: almacenan información del comportamiento de los usuarios obtenida a
    través de la observación continuada de sus hábitos de navegación, lo que permite desarrollar un perfil específico
    para mostrar publicidad en función del mismo.<br/>
    • Cookies de redes sociales externas: se utilizan para que los visitantes puedan interactuar con el contenido de
    diferentes plataformas sociales (facebook, youtube, twitter, linkedIn, etc..) y que se generen únicamente para
    los usuarios de dichas redes sociales. Las condiciones de utilización de estas cookies y la información recopilada
    se regula por la política de privacidad de la plataforma social correspondiente.<br/>
    <h3>Desactivación y eliminación de cookies</h3>
    Tienes la opción de permitir, bloquear o eliminar las cookies instaladas en tu equipo mediante la configuración de las opciones del
    navegador instalado en su equipo.<br/>Al desactivar cookies, algunos de los servicios disponibles podrían dejar de estar operativos.<br/>La
    forma de deshabilitar las cookies es diferente para cada navegador, pero normalmente puede hacerse desde el menú Herramientas
    u Opciones.<br/>También puede consultarse el menú de Ayuda del navegador dónde puedes encontrar instrucciones.<br/>El usuario podrá
    en cualquier momento elegir qué cookies quiere que funcionen en este sitio web.<br/>
    Puede usted permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la configuración de las opciones del
    navegador instalado en su ordenador:<br/>
    • Microsoft Internet Explorer o Microsoft Edge: http://windows.microsoft.com/es-es/windows-vista/Block-or-allow-cookies<br/>
    • Mozilla Firefox: http://support.mozilla.org/es/kb/impedir-que-los-sitios-web-guarden-sus-preferencia<br/>
    • Chrome: https://support.google.com/accounts/answer/61416?hl=es<br/>
    • Safari: http://safari.helpmax.net/es/privacidad-y-seguridad/como-gestionar-las-cookies/<br/>
    • Opera: http://help.opera.com/Linux/10.60/es-ES/cookies.html<br/>
    Además, también puede gestionar el almacén de cookies en su navegador a través de herramientas como las siguientes<br/>
    • Ghostery: www.ghostery.com/<br/>
    • Your online choices: www.youronlinechoices.com/es/<br/>
    Cookies utilizadas en {{session("entorno")->config->x_nomemp}}<br/>
    A continuación se identifican las cookies que están siendo utilizadas en este portal así como su tipología y función:<br/>
    <h3>Aceptación de la Política de cookies</h3>
    {{session("entorno")->config->x_nomemp}} asume que usted acepta el uso de cookies.<br/>No obstante, muestra información sobre su Política de cookies en la parte
    inferior o superior de cualquier página del portal con cada inicio de sesión con el objeto de que usted sea consciente.<br/>
    Ante esta información es posible llevar a cabo las siguientes acciones:<br/>
    • Aceptar cookies. No se volverá a visualizar este aviso al acceder a cualquier página del portal durante la
    presente sesión.<br/>
    • Cerrar. Se oculta el aviso en la presente página.<br/>
    • Modificar su configuración. Podrá obtener más información sobre qué son las cookies, conocer la Política de
    cookies de {{session("entorno")->config->x_nomemp}} y modificar la configuración de su navegador.
    </p>
    <h1 id="privacidad" name="privacidad">
    {{T::tr('Aviso de privacidad')}}
    </h1>
    <p style="text-align:justify">
    <h3>1. DATOS IDENTIFICATIVOS</h3>
    En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico, a continuación se reflejan los siguientes datos:<br/> 
    La empresa titular del presente dominio web es {{session("entorno")->config->x_nomemp}}, con domicilio a estos efectos en {{session("entorno")->config->x_domemp}} {{session("entorno")->config->x_pobemp}} {{session("entorno")->config->x_cpostal}} número de C.I.F.: {{session("entorno")->config->x_cpostal}}. Correo electrónico de contacto: {{session("entorno")->config->x_em1dir}}.<br/>
    <h3>2. USUARIOS</h3>
    El acceso y/o uso de este portal ó sitio web le  atribuye la condición de USUARIO, que acepta, desde dicho acceso y/o uso, las Condiciones Generales de Uso reflejadas en el presente aviso.<br/>Las Condiciones serán de aplicación independientemente de las Condiciones Generales de Contratación que en su caso resulten de obligado cumplimiento.<br/>En todo caso para cualquier fin especifico se pedira su consentimiento expreso.<br/>
    <h3>3. USO DEL PORTAL</h3>
    Nuestra web proporciona el acceso a  informaciones, servicios, programas o datos (en adelante pasaremos a denominarlos como  “los contenidos”) en Internet pertenecientes a {{session("entorno")->config->x_nomemp}} o a sus licenciantes a los que el USUARIO pueda tener acceso.<br/>El USUARIO asume la responsabilidad del correcto uso del portal. Dicha responsabilidad se extiende al registro que fuese necesario para acceder a determinados servicios o contenidos.<br/>
    En dicho registro el USUARIO será responsable de aportar información veraz y lícita sobre sus datos.<br/>Como consecuencia de este registro, al USUARIO se le puede proporcionar una contraseña de la que será responsable, comprometiéndose a hacer un uso diligente, ético y confidencial de la misma.<br/>El USUARIO se compromete a hacer un uso adecuado de los contenidos y servicios (como por ejemplo servicios de chat, foros de discusión o grupos de noticias) que se ofrece a través de su portal y con carácter enunciativo pero no limitativo, a no emplearlos para:<br/>
    - Incurrir en actividades ilícitas, ilegales o contrarias a la buena fe y al orden público.<br/>
    - Difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico-ilegal, de apología del terrorismo o atentatorio contra los derechos humanos.<br/>
    - Provocar daños en los sistemas físicos y lógicos del propietario, de sus proveedores o de terceras personas, introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar los daños anteriormente mencionados.<br/>
    - Intentar acceder y, en su caso, utilizar las cuentas de correo electrónico de otros usuarios y modificar o manipular sus mensajes.<br/>El propietario del portal se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren el respeto a la dignidad de la persona, que sean discriminatorios, xenófobos, racistas, pornográficos, que atenten contra la juventud o la infancia, el orden o la seguridad pública o que, a su juicio, no resultaran adecuados o convenientes  para su publicación.<br/>En cualquier caso, el propietario del portal  no será responsable de las opiniones vertidas por los usuarios a través de los foros, chats, u otras herramientas de participación.<br/>
    <h3>4. PROTECCIÓN DE DATOS Y USO DE COOKIES</h3>
    El uso de los datos personales está definida en base al Reglamento General de Protección de datos , a la LOPD y la normativa española vigente.<br/>Con el fin de conseguir la máxima transparencia y en base a nuestra política proactiva le informamos:<br/>
    ¿Por qué solicitamos sus datos?<br/>
    ¿Que tipo de datos recabamos?<br/>
    ¿Como se recogen?<br/>
    Uso compartido con terceros:<br/>
    Derechos: Tiene derecho a acceder a sus datos, rectificarlos, suprimirlos, limitarlos y oponerse a su tratamiento en cualquier momento, tambien puede retirar el consentimiento prestado y reclamar ante la autoridad de control (Agencia Española de protección de Datos c/ Jorge Juan nº6 28001 Madrid).<br/>Para el ejercicio de sus derechos dispone de un canal directo con nuestra empresa en el mail {{session("entorno")->config->x_em1dir}} y en la dirección postal {{session("entorno")->config->x_domemp}} indicando en el asunto protección de datos.<br/>
    Privacidad en la navegación:<br/>
    El propietario del portal se toma la privacidad muy en serio, y se esfuerza por la transparencia en todos los aspectos relacionados con los datos personales.<br/>Si desea configurar las cookies adjuntamos los enlaces correspondientes a cada navegador.<br/>Rogamos consulte la política de cookies de nuestra web para obtener más información.<br/>
    Puede encontrar más información sobre cómo cambiar la configuración de las cookies en el explorador que utiliza en la siguiente lista:<br/>
    •	https://www.google.com/intl/en/policies/technologies/managing/ <br/>
    •	http://support.mozilla.com/en-GB/kb/Cookies#w_cookie-settings <br/>
    •	http://windows.microsoft.com/en-GB/windows-vista/Block-or-allow-cookies <br/>
    •	http://www.apple.com/safari/features.html#security <br/>
    Asimismo, {{session("entorno")->config->x_nomemp}} informa que da cumplimiento a la Ley 34/2002 de 11 de julio, de Servicios de la Sociedad de la Información y el Comercio Electrónico y le solicitará su consentimiento al tratamiento de su correo electrónico con fines comerciales en cada momento.<br/>
    <h3>5. PROPIEDAD INTELECTUAL E INDUSTRIAL</h3>
    El propietario por sí o como cesionaria, es titular de todos los derechos de propiedad intelectual e industrial desu página web, así como de los elementos contenidos en la misma (a título enunciativo, imágenes, sonido, audio, vídeo, software o textos, marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.).<br/>
    Todos los derechos reservados. En virtud de lo dispuesto en los artículos 8 y 32.1, párrafo segundo, de la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de {{session("entorno")->config->x_nomemp}}.<br/>
    El USUARIO se compromete a respetar los derechos de Propiedad Intelectual e Industrial titularidad de {{session("entorno")->config->x_nomemp}}.<br/>Podrá visualizar los elementos del portal e incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte físico siempre y cuando sea, única y exclusivamente, para su uso personal y privado.<br/>El USUARIO deberá abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en el las páginas de {{session("entorno")->config->x_nomemp}}.<br/>
    <h3>6. EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD</h3>
    {{session("entorno")->config->x_nomemp}} no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran ocasionar, a título enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo.<br/>
    <h3>7. MODIFICACIONES</h3>
    {{session("entorno")->config->x_nomemp}} se reserva el derecho de efectuar sin previo aviso las modificaciones que considere oportunas en su portal, pudiendo cambiar, suprimir o añadir tanto los contenidos y servicios que se presten a través de la misma como la forma en la que éstos aparezcan presentados o localizados en su portal.<br/>
    <h3>8. ENLACES</h3>
    En el caso de que en {{session("entorno")->config->x_nomemp}} se dispusiesen enlaces o hipervínculos hacia otros sitios de Internet, no ejercerá ningún tipo de control sobre dichos sitios y contenidos.<br/>En ningún caso {{session("entorno")->config->x_nomemp}} asumirá responsabilidad alguna por los contenidos de algún enlace perteneciente a un sitio web ajeno, ni garantizará la disponibilidad técnica, calidad, fiabilidad, exactitud, amplitud, veracidad, validez y
    constitucionalidad de cualquier material o información contenida en ninguno de dichos hipervínculos u otros sitios de Internet.<br/>En caso de usar los enlaces rogamos que acceda a la política de privacidad y aviso legal de la página visitada.<br/>
    Igualmente la inclusión de estas conexiones externas no implicará ningún tipo de asociación, fusión o participación con las entidades conectadas.<br/>
    <h3>9. DERECHO DE EXCLUSIÓN</h3>
    {{session("entorno")->config->x_nomemp}} se reserva el derecho a denegar o retirar el acceso a portal y/o los servicios ofrecidos sin necesidad de preaviso, a instancia propia o de un tercero, a aquellos usuarios que incumplan las presentes Condiciones Generales de Uso.<br/>
    <h3>10.GENERALIDADES</h3>
    Se perseguirá el incumplimiento de las presentes condiciones así como cualquier utilización indebida de su portal ejerciendo todas las acciones civiles y penales que le puedan corresponder en derecho.<br/>
    <h3>11. MODIFICACIÓN DE LAS PRESENTES CONDICIONES Y DURACIÓN</h3>
    {{session("entorno")->config->x_nomemp}} podrá modificar en cualquier momento las condiciones aquí determinadas, siendo debidamente publicadas como aquí aparecen.<br/>
    La vigencia de las citadas condiciones irá en función de su exposición y estarán vigentes hasta que sean modificadas por otras.<br/>
    <h3>12. LEGISLACIÓN APLICABLE Y JURISDICCIÓN</h3>
    La relación entre {{session("entorno")->config->x_nomemp}} y el USUARIO se regirá por la normativa española vigente y cualquier controversia se someterá a la autoridad pertinente.<br/>
    </p>
@endif
@if($idioma==2000)
    <p>
    <h5>
        por cada nuevo idioma podemos configurar una nueva política de cookies y de privacidad
    <br/>
    </h5>
    </p>
@endif
@endsection
