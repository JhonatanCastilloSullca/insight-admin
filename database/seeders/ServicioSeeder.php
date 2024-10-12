<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;
use App\Models\CategoriaServicio;
use App\Models\EtiquetaServicio;
use App\Models\ServicioUbicacion;


class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $detallesvuelos = [
            'Facturado',
            'Mochila',
            'Bodega',
        ];
        $vuelos = [
            'Latam Economico',
            'Latam Premium',
            'Latam Business',
            'Sky Economico',
            'Sky Premium',
            'Sky Business',
        ];
        $hoteles = [
            'Casa Blanca Habitacion Simple',
            'Casa Blanca Habitacion Matrimonial',
            'Casa Blanca Habitacion Doble',
            'Casa Blanca Habitacion Triple',
            'Casa Negra Habitacion Simple',
            'Casa Negra Habitacion Matrimonial',
            'Casa Negra Habitacion Doble',
            'Casa Negra Habitacion Triple',
        ];
        $elementos = [
            'Recojo Hotel en Zona Centrica',
            'Movilidad Turistica',
            'Ingresos',
            'Guia Profesional',
            'Balneario Paracas',
            'Islas Ballestas',
            'Ruta del Pisco',
            'Tubulares Sandboarding',
            'Ticket de bus Lima - Nazca',
            'Ticket de bus Nazca - Nazca',
            'Traslado estación de bus al Aeródromo María Reiche',
            'Traslado de retorno Estación Cruz de Sur Nazca',
            'Ticket de sobrevuelo a las Líneas de Nazca',
            'Asistencia profesional',
            'Impuesto Aeródromo',
            'Impuesto Turístico',
            'Implementos',
            'Almuerzo',
            'Almuerzo Buffet',
            'Desayuno',
            'Desayuno Buffet',
            'Cena',
            'Cena Buffet',
            'Primeros Auxilios',
            'Oxigeno',
            'Tren de Ida Machupicchu',
            'Tren de Vuelta Machupicchu',
            'Bus de Subida Machupicchu',
            'Bus de Retorno Machupicchu',
            'Frutos Secos',
            'Variedad de Quesos',
            'Vino',
            'Cuadro para pintar',
            'Materiales de Pintura',
            'Masa madre panaderia',
            'Paseo en Bote',
            'Paseo en Kayak',
            'Paseo en Paddle',
            'Paseo en Inca Buggy',
            'Torito de Pucara',
            '1 Bebida',
            'Paquete de Bebidas',
            'Servicio Lancha',
            'Servicio Lancha a Motor',
            'Estancia Vivencial',
            'Transporte Ida Ollantaytambo',
            'Transporte Vuelta Ollantaytambo',
            'Bus Ida Tour',
            'Bus Vuelta Tour',
            'Boleto Turistico',
        ];
        $elementos2 = [
            ['Recojo de Aeropuerto Lima','Mensaje de Bienvenida Lima'],
            ['Recojo de Aeropuerto Cusco','Mensaje de Bienvenida Cusco'],
        ];

        $categoria_id_servicio = 2;

        foreach ($elementos as $elemento) {
            Servicio::create([
                'titulo'        => $elemento,
                'categoria_id'  => 4,
            ]);
        }
        foreach ($elementos as $elemento) {
            Servicio::create([
                'titulo'        => $elemento,
                'categoria_id'  => 4,
            ]);
        }
        foreach ($elementos2 as $elemento) {
            Servicio::create([
                'titulo'        => $elemento[0],
                'categoria_id'  => 7,
                'operar'        => 2,
            ]);
        }

        $tours = [
            ["CITY TOUR LIMA","La Capital del Perú, una ciudad de contrastes","El guía El guía oficial de turismo estará esperando para el recojo desde su Hotel (ubicado en la zona de Miraflores). El tour iniciará en el distrito de Miraflores, durante el camino se apreciará desde el bus la impresionante “Huaca Pucllana”, antiguo Centro Ceremonial. Luego, visitaremos el Centro Histórico de Lima, donde se apreciará lo que fue la antigua Lima Colonial, La Plaza San Martin, La Plaza Mayor, entre otros. Después, conocerás la Plaza Mayor donde se puede apreciar el Palacio de Gobierno, El Palacio Municipal y Arzobispal, La Basílica Catedral, Ingresarás la Convento de San Francisco y sus Catacumbas. Continuando el recorrido conocerás Museo del banco Central de Reserva. Finalmente se visitará a la Zona Contemporánea o Moderna de Lima como El Parque del Olivar, Parque del Amor y Larcomar","/storage/servicios/city-tour-lima.png","null","0.5","121","28","121","28","null","09:00 - 14:00 / 13:00 - 18:00","1","1"," MINIMO 2 PERSONAS PARA LA RESERVA DEL TOUR *Los días lunes el Banco Central de reserva esta cerrado (BCR)O 2 PERSONAS PARA LA RESERVA DEL TOUR"],
            ["ICA PARACAS HUACACHINA","Explora el Oasis del Desierto de Huacachina","A la hora indicada el guía oficial de turismo junto con la movilidad (frente a Larcomar), van a partir rumbo al Balneario de Paracas. Realizaremos una parada en Chilca para desayunar (no incluido). Arribamos al Balneario de Paracas, desde donde se partirá a las Islas Ballestas, donde observaremos: leones marinos, pingüinos, flamencos, parihuanas y diversas aves marinas). Al término de la excursión habrá un tiempo para comprar y comer para luego dirigirnos a Ica, al llegar haremos la excursión al Oasis de La Huacachina. En esta hermosa laguna podrán caminar por los alrededores en busca de buenas fotos e ir al Restaurante ‘’Catador ‘’ donde se elabora el Pisco. Luego se darán las indicaciones para subir a los famosos carros areneros y realizar Sandboarding.","/storage/servicios/ica-paracas-huacachina.png","null","1","312","89","312","89","null","04:30 - 23:00","1","1",""],
            ["ICA / NAZCA SOBRE VUELO","Un viaje al misterio y la maravilla","DIA 01: 21:00 PM Recojo desde su Hotel en Miraflores. 22:15 PM. Salida a Nazca vía Cruz del Sur (Servicio Cruzero Evolution 140°) DIA 02: 05:15 AM Arribo a Nazca (Tiempo libre para desayunar) 08:45 AM Luego nos trasladaremos al Aeródromo de Nazca para observar un video sobre la gente de Nazca (200 a.C. - 900 d.C.), sus costumbres y actividades principales. Luego tomaremos una avioneta y sobrevolaremos las enigmáticas Líneas de Nazca durante 35 minutos. Estos enormes dibujos lineales de animales, pájaros y figuras geométricas se mantienen intactos en el desierto y solo pueden apreciarse desde el aire. Retorno al terminal Cruz del sur  Tiempo Libre para poder realizar compras. 13:00 PM Traslado a la Estación Cruz del sur Nazca 14:00 P.M. Retorno a Lima vía Cruz del Sur (Servicio Cruzero Evolution 140°)  21:30 P.M. Llegada al terminal de cruz del sur Javier Prado y traslado a su Hotel.","/storage/servicios/ica-nazca-sobre-vuelo.png","null","2","923","250","923","250","null","04:00 - 17:00____04:00 - 20:00","1","1",""],
            ["CITY TOUR - CUSCO","La Ciudad Imperial","Primer lugar de visita Qoricancha(templo del sol), visita guiada de 45 minutos para luego dirigirnos a la movilidad. Después de 30 minutos en la movilidad llegaremos a Sacsayhuamán donde tendremos una visita guiada de 1 hora. Visitaremos Qenqo (centro ritual en un afloramiento rocoso) lugar de mucho misticismo que lo sentirán al entrar al afloramiento rocoso. Después de 15 minutos de movilidad llegaremos a Puca Pucara (fortaleza roja) construcción militar. Última visita será Tambomachay conocido como Baño del Inca donde se realizaba culto al agua. Después de nuestra travesía tomaremos la movilidad para el retorno a Cusco.","/storage/servicios/city-tour-cusco.png","null","1","46.77","18","46.77","18","null","09:00 - 13:00 / 13:40 - 18:00","1","1",""],
            ["MARAS / MORAY","Ingeniería agrícola inca","DE RECOJO DE LA PLAZA DE REGOCIJO (RECOJO DE HOTELES CERCA A LA PLAZA DE ARMAS) Viajaremos a la localidad de Moray, donde los Incas experimentaban las diferentes altitudes geográficas para aprovechar el potencial agrícola de sus tierras. La combinación de la historia y sus espectaculares vistas te sorprenderán. Conoceremos Maras que son las famosas pozas de sal tan altamente identificadas por su geografía y por la calidad de sal de exportación finalmente retornaremos a Cusco.GOCIJO","/storage/servicios/maras-moray.png","null","0.5","65","25","65","25","null","08:50 - 15:00","1","1",""],
            ["MARAS / MORAY CUATRIMOTO","Un recorrido emocionante por los Andes","RECOJO DE LA PLAZOLETA DE REGOCIJO En este destino nuestros viajeros podrán apreciar la belleza del Valle Sagrado, nos dirigiremos hasta nuestra base en cruzpata, en este lugar el instructor de manejo nos enseñara el uso de nuestra cuatrimoto de 4 ruedas gigante, nos dirigiremos hacia el parque arqueológico de Moray. ¡No olvides llevar tu boleto turístico! Manejaremos por casi 1.5 horas hasta llegar a Moray, sitio arqueológico que funcionaba como un centro de investigación agrícola, pero también tenía funciones importantes en la política y la religión incaica. De retorno a la base dejaremos las cuatrimotos y volveremos a nuestro vehículo que se dirigirá por 20 minutos de distancia hacia la hermosa salineras de maras que es un conjunto de aproximadamente 4500 pozas de sal ubicadas en forma de terrazas escalonadas en la falda media del cerro qaqa wiñay.","/storage/servicios/maras-moray-cuatrimoto.png","null","0.5","125","47","125","47","null","06:50 - 13:30 / 13:00 - 19:30","1","1","ESTE TOUR SOLO LO PUEDDES HACER SI SABES MANEJAR MOTO O CUATRIMOTO"],
            ["MARAS / LAGUNA HUAYPO CUATRIMOTO","Una experiencia de adrenalina y cultura","RECOJO DE LA PLAZOLETA DE REGOCIJO U HOTELES CERCANOS A LA PLAZA DE ARMAS En este destino nuestros viajeros podrán apreciar la belleza del Valle Sagrado, nos dirigiremos hasta nuestra base en cruzpata, en este lugar el instructor de manejo nos enseñara el uso de nuestra cuatrimoto de 4 ruedas gigante, nos dirigiremos hacia la laguna de Huaypo. Manejaremos por casi 1.5 horas hasta llegar a Huaypo , laguna mas importante de la region del Cusco. De retorno a la base dejaremos las cuatrimotos y volveremos a nuestro vehículo que se dirigirá por 20 minutos de distancia hacia la hermosa salineras de maras que es un conjunto de aproximadamente 4500 pozas de sal ubicadas en forma de terrazas escalonadas en la falda media del cerro qaqa wiñay.","/storage/servicios/maras-moray-cuatrimoto.png","null","0.5","125","47","125","47","null","06:50 - 13:30 / 13:00 - 19:30","1","1","ESTE TOUR SOLO LO PUEDDES HACER SI SABES MANEJAR MOTO O CUATRIMOTO"],
            ["MORADA DE DIOSES CUATRIMOTO","Una aventura mística","En este destino nos dirigimos al poblado de Tica Tica hasta llegar al sector Sencca, la duración del trayecto es de 25 minutos y el recojo es desde la plazoleta de Regocijo .Una vez ahí empezamos un “briefing” de seguridad de 5 minutos seguido de 10 minutos de entrenamiento con las Cuatrimotos cuando los pasajeros se encuentren listos empezamos la aventura. El recorrido en cuatrimotos tiene una duración de 1 hora, primero visitaremos el Acueducto Colonial Fortaleza, luego continuaremos hasta la Morada de los Dioses, una vez llegado comenzaremos con la visita de aproximadamente 30 minutos donde podremos apreciar las diversas esculturas hechas a mano, que son recontra instagrameables Finalizada la visita retornaremos hasta el campamento para abordar nuestro transporte y retornar a la ciudad de Cusco. llegando a la Calle Saphy, a una cuadra de la Plaza de Armas.","/storage/servicios/morada-de-dioses-cuatrimoto.png","null","0.5","98","37","98","37","null","08:00 - 11:00 / 10:00 - 13:00 / 13:00 - 15:00 / 15:00 - 18:00","1","1","RESERVA MINIMA DESDE 2 PERSONAS"],
            ["VALLE SUR","El corazón de la cultura cusqueña y la fe","ECOJO DEL PUNTO DE ENCUENTRO (HOTELES CERCA A LA PLAZA DE ARMAS) Realizaremos un viaje de 40 minutos al suroeste de la ciudad del Cusco. Después nos dirigiremos a PIKILLACTA es conocida en la actualidad como una de las ciudades más famosas y mejor conservadas del periodo pre inca en Perú y cuenta con un área de 50 hectáreas aproximadamente. Además, visitaremos la mano gigante de Huaro y las ruinas de Tipon. Finalmente conoceremos Andahuaylillas que es parte de la Ruta del Barroco Andino y su increíble Capilla más conocida como la Capilla Sixtina de América debido a sus bellos trabajos en madera, hermosas pinturas y decoraciones coloniales. Según coordinación con el grupo podrán hacer una parada en Saylla para probar un rico Chicharrón Cusqueño.","/storage/servicios/valle-sur.png","null","1","65","25","65","25","null","08:50 - 15:00","1","1",""],
            ["VALLE SAGRADO 3 LUGARES","La joya de los Andes","El recojo de tu hotel en Cusco ciudad será a las 7:30 am para iniciar el recorrido del valle sagrado Visitaremos: Pisac (ave rapiña) Chinchero Ollantaytambo (tambo del inca) Luego de viajar 1 hora en nuestra movilidad llegaremos al centro arqueologico de Pisac donde tendremos una visita guiada de 1 hora aprox Viajando en la dirección del río Willka mayu o río sagrado llegaremos al poblado de Ollantaytambo para visitar la fortaleza donde tendremos una visita guiada de 1 hora. Destacaremos el Templo del Sol, El Intihuatana, los Baños de la Princesa y terrazas andinas.Después tendremos un almuerzo buffet (comida típica andina). Para finalizar llegaremos al poblado de Chincheros donde visitaremos la parte arqueològica, que cuenta con una construcción del siglo XVII y observaremos el taller de fabricación tradicional de textiles","/storage/servicios/valle-sagrado-3-lugares.png","null","1","140","54","140","54","null","07:30 - 18:30","1","1",""],
            ["VALLE SAGRADO 5 LUGARES","5 lugares para descubrir la magia de los Andes","El toISITAS: Parque Arqueológico de Chinchero Proceso de la Lana Salineras de Maras Parque Arqueológico de Ollantaytambo Parque Arqueológico de Pisac (solo si por la hora logramos llegar) hora de cierre 5:00 p.m Recojo de 6:00 a.m. en el casco monumental, una vez que todo el grupo esté completo, partiremos con dirección al norte. Conocerás Moray, las andenerías circulares. luego, Chinchero continuaremos hasta las Salineras de Maras, en este lugar observaremos el proceso natural de extracción de sal que data desde el tiempo de los Incas. Luego almorzarás en un restaurante buffet para seguir hacia la Fortaleza de Ollantaytambo. Para finalmente, ir a Pisac El yacimiento arqueológico es uno de los más importantes y visitados del Valle Sagradour iniciará en el distrito de Miraflores, durante el camino se apreciará desde el bus la impresionante “Huaca Pucllana”, antiguo Centro Ceremonial. Luego, visitaremos el Centro Histórico de Lima, donde se apreciará lo que fue la antigua Lima Colonial, La Plaza San Martin, La Plaza Mayor, entre otros.","/storage/servicios/valle-sagrado-5-lugares.png","null","1","146","57","146","57","null","06:30 - 19:00","1","1",""],
            ["Vinincunca o Montaña de 7 colores","El arcoíris de los Andes"," Pasaremos, en nuestro transporte a recogerlo en el punto de encuentro para viajar por 2 horas y 30 minutos hasta llegar al pueblo de Anchi pacha, donde disfrutaremos un desayuno buffet. Despues, continuaremos nuestro viaje hacia el inicio del sendero llamado Quesyuno (4.326 m / 14.189 ft.). A lo largo de este camino hay unas vistas impresionantes de terrazas de agricultura, cañones y nevados. Durante el trayecto se apreciará una variedad de camélidos sudamericanos, espectaculares ecosistemas propios de este lugar y vistas del nevado del Ausangate. A las 10:30 aproximadamente arribaremos a nuestro destino llamado Vinicunca o la Montaña del Arco Iris (5.020 m / 16.466 ft.) después de una vista del lugar comenzaremos el descenso por el mismo camino hasta la movilidad para luego retornar al restaurante. Luego, disfrutaremos de un delicioso almuerzo buffet y después de un pequeño descanso vamos a emprender el viaje de retorno a Cusco.","/storage/servicios/vinincunca-o-montana-de-7-colores.png","null","1","110","35","110","35","null","04:00 - 05:30","1","1",""],
            ["Laguna Humantay","","pasaremos a recoger a su receptivo hotel con la movilidad viajaremos hasta el poblado de Mollepata donde tomaremos el desayuno. Luego, continuaremos nuestro recorrido a Soraypampa donde comenzaremos con nuestra caminata de 1 hora y 30 minutos a la laguna Humantay que tiene una altitud de 4 250 m.s.n.m durante el recorrido apreciamos la fauna y flora del lugar. Finalmente, descenderemos a Soraypampa para poder tomar la movilidad hacia Mollepata donde disfrutaremos de un almuerzo delicioso para luego retornar a la ciudad del Cusco llegada aprox. 6:00 pm.","/storage/servicios/laguna-humantay.png","null","1","110","35","110","35","null","04:00 - 18:30","1","1",""],
            ["Machupicchu FULL DAY con tren Expedition","Machupicchu, un sueño hecho realidad","Nuestra movilidad te recogerá de tu hotel para dirigirse hacia la estación ferroviaria de Ollantaytambo por un promedio de 2 horas aprox.  Al llegar a la estación se abordará el tren turístico que los llevará hacia Machu Picchu. Llegando a Aguas Calientes nuestro guía o transfer nos espera con un letrero para coordinar.  Nos encontraremos con nuestro guía, en la estación de tren en el pueblo de Machupicchu, junto a el subiremos al Bus Consetur. Al llegar a la ciudadela de Machupicchu para ingresar mostraremos el boleto de ingreso y el DNI o pasaporte (cédula). Después de la visita a Machu Picchu retornaremos a la estación de tren . Ya en la estación de Ollantaytambo los estará esperando su movilidad para retornar a Cusco y llevarlo hasta el hotel.","/storage/servicios/machupicchu-full-day-con-tren-expedition.png","null","1","895","295","895","295","null","SEGUN INGRESO A MACHUPICCHU","1","1",""],
            ["Tren Observatorio / Retorno expedition","Machupicchu Una experiencia que nunca olvidarás","l recojo de tu hotel en Cusco ciudad será a las 4:30 am. para dirigirse hacia la estación ferroviaria de Ollantaytambo. Al llegar a la estación, abordará el tren  Llegaran a Machupicchu pueblo, donde nuestro guía local te esperará con un letrero en la puerta de la estación de tren. Realizará el recorrido por aproximadamente 3 horas dentro de la Maravilla. Si compra su viaje con tres meses de anticipación, Cuzco Travel comprará el ingreso a Llaqta Machu Picchu. Segun disponibilidad. Después del recorrido, usted retornará a Machu Picchu Pueblo y tendrá un pequeño tiempo libre antes de volver a la estación de tren. Finalmente, en Ollantaytambo, nuestra movilidad estará esperando para llevarlo de regreso a Cusco","/storage/servicios/tren-observatorio-retorno-expedition.png","null","1","1167","380","1167","380","null","04:00 - segun horario","1","1",""],
            ["Tren Observatorio / Retorno Observatorio","Machupicchu, Un encuentro con la naturaleza y la cultura",":30 Recojo de tu hotel en Cusco ciudad. Nuestra movilidad le recogerá de su hotel para dirigirse hacia la estación ferroviaria de Ollantaytambo. Al llegar a la estación, abordará el tren turístico VISTADOME OBSERVATORIO. Llegaremos a Machupicchu pueblo, donde nuestro guía local te esperará con un letrero en la puerta de la estación de tren. Junto a nuestro guía, usted realizará el recorrido por aproximadamente 3 horas dentro de la Maravilla. Si compra su viaje con tres meses de anticipación, Cuzco Travel comprará el ingreso a Llaqta Machu Picchu Si compra con poco tiempo de anticipación, tendrá otra ruta de acceso (según disponibilidad del ministerio de turismo). Después del recorrido, usted retornará a Machu Picchu Pueblo y tendrá un pequeño tiempo libre antes de volver a la estación de tren. Finalmente, en Ollantaytambo, nuestra movilidad estará esperando para llevarlo de regreso a Cusco","/storage/servicios/tren-observatorio-retorno-observatorio.png","null","1","1378","438","1378","438","null","04:00 - 16:00","1","1",""],
            ["PICNIC MARAS","Un momento de relax y disfrute en el corazón de Cusco","Si! este precioso dibujo animado que veíamos con ansia cuando éramos niños, en los Alpes suizos rodeados de hermosas montañas y sus lindas cabras en sus praderas, pues nosotros en Cusco tenemos la casa de Heidi en las pampas del Valle Sagrado en este lugar podrás disfrutar de las montañas mientras pintas un cuadro frente al nevado Chicon y disfrutas de un delicioso picnic. Si tu plan es disfrutar al máximo de la tranquilidad de Cusco y pasar momento románticos y especiales con tus amigos, pareja definitivamente amarás este destino.","/storage/servicios/picnic-maras.png","null","1","303","85","303","85","null","Definir con viajero","1","1","Minimo 2 personas"],
            ["Buggies en Huaypo","Una experiencia de adrenalina a través de los paisajes andinos","Descubre la increíble laguna de Huaypo, conduciendo el Inca Buggy entre espectaculares carreteras 100 % off-road con vistas espectaculares del valle sagrado","/storage/servicios/buggies-en-huaypo.png","null","1","317","104","317","104","null","Definir con viajero","1","1","Minimo 2 personas"],
            ["Taller de pintura de toros","Desarrolla tu creatividad y tu sensibilidad artística","El tour iniciará en el distrito deEl taller de pintura inicia con una breve explicación de la pieza a pintar, sobre su significado en la cultura andina y su origen. Seguidamente entregamos a los participantes el material correspondiente y empezamos a pintar según al gusto de diseño elegido por el participante, guiado por un artista profesional que estará a disposición para cualquier ayuda o interrogante. Todo ello acompañado de una bebida y conversaciones amenas entre los participantes y el artista. Una vez que el pintado haya sido concluido, el artista retoca y mejora algunos trazos de la pintura para que los participantes se lleven no solo un lindo recuerdo de la experiencia si no una hermosa pieza de arte. Miraflores, durante el camino se apreciará desde el bus la impresionante “Huaca Pucllana”, antiguo Centro Ceremonial. Luego, visitaremos el Centro Histórico de Lima, donde se apreciará lo que fue la antigua Lima Colonial, La Plaza San Martin, La Plaza Mayor, entre otros.","/storage/servicios/taller-de-pintura-de-toros.png","null","1","128","34","128","34","null","Definir con viajero","1","1","Minimo 2 personas"],
            ["Qeswachaka","Puente de tradiciones y resiliencia","Partiremos hacia el restaurante turístico en CCOLCCA, donde tendremos el desayuno, luego tomaremos nuestro transporte y viajaremos durante 25 minutos hasta observar las lagunas de POMACANCHI, ACOPIA, ASNAQOCHA y PAMPA MARCA. Luego de la visitar el circuito de las 4 lagunas pasaremos pequeños pueblos históricos: como el pueblo de (Túpac Amaru II) y visitaremos la casa. Continuando con nuestro recorrido llegaremos hasta el puente inca de Queswachaka, reviviremos la cultura inca en el lugar. Nuestra última parada será el puente colonial de combapata","/storage/servicios/qeswachaka.png","null","1","584","227","584","227","null","04:00 - 18:30","1","1","Minimo 2 personas"],
            ["Puno 1 Dia"," Un mundo flotante en el lago Titicaca","En esta emocionante aventura, viajamos un dia antes a las 10 pm desde Cusco para iniciar temprano a las 6:30 Am Exploramos las Islas Flotantes de los Uros y visitamos dos de sus más de 90 islas. Luego, continuamos hacia la Isla Taquile, “Patrimonio Cultural Inmaterial de la UNESCO”, famosa por su artesanía textil. Descubrimos las tradiciones locales y disfrutamos de paisajes impresionantes.","/storage/servicios/puno-1-dia.png","null","1","472","133","472","133","null","20:00__06:30 - 18:30","1","1",""],
            ["Puno 2 Dias"," Puno: La puerta de entrada a la cultura y la naturaleza de los Andes","DIA 1: Iniciaremos nuestro viaje dirigiéndonos al puerto, donde abordaremos un bote que nos llevará a las Islas Flotantes de los Uros, un trayecto de aproximadamente 20 minutos. Allí, seremos recibidos por los pobladores, y nuestro guía nos proporcionará una detallada explicación sobre la vida, costumbres y características de este lugar fascinante. Visitaremos dos de las más de 90 islas de los Uros. Luego, nos dirigiremos a la Isla Amantani en un viaje en bote (02 horas y 30 min). Por la tarde, haremos una caminata hacia los templos pre-incas Pachatata y Pachamama. Experimentaremos un asombroso atardecer y participaremos en una acogedora fiesta de bienvenida organizada por una familia local. DIA 2: Después del desayuno a las 7:00 a.m., nos dirigimos en un viaje de aproximadamente 1 hora hacia la hermosa Isla Taquile. Al llegar al puerto, caminamos unos 45 minutos hasta la plaza principal, donde exploramos los centros de artesanía, famosos por sus tejidos reconocidos como” Patrimonio Cultural Inmaterial de la Humanidad por la UNESCO”. Luego, disfrutamos de un almuerzo en un restaurante local antes de descender al puerto de Taquile. Finalmente, regresamos a la ciudad de Puno en un trayecto de aproximada","/storage/servicios/puno-2-dia.png","null","2","639","231","639","231","null","20:00__07:00 - __ 15:00","1","1",""],
        ];

        foreach ($tours as $elemento) {
            Servicio::create([

                'titulo'            => $elemento[0],
                'subtitulo'         => $elemento[1],
                'descripcion'       => $elemento[2],
                'img_principal'     => $elemento[3],
                'video'             => $elemento[4],
                'duracion'          => $elemento[5],
                'precio_neto_soles' => $elemento[6],
                'precio_neto_dolar' => $elemento[7],
                'precio_min_soles'  => $elemento[8],
                'precio_min_dolar'  => $elemento[9],
                'recojo'            => $elemento[10],
                'horario'           => $elemento[11],
                'categoria_id'      => 1,
                'user_id'           => $elemento[13],
                'condicion'         => $elemento[14],
            ]);
        }

        $Tour1  = Servicio::where('id', '53')->first();
        $Tour2  = Servicio::where('id', '54')->first();
        $Tour3  = Servicio::where('id', '55')->first();
        $Tour4  = Servicio::where('id', '56')->first();
        $Tour5  = Servicio::where('id', '57')->first();
        $Tour6  = Servicio::where('id', '58')->first();
        $Tour7  = Servicio::where('id', '59')->first();
        $Tour8  = Servicio::where('id', '60')->first();
        $Tour9  = Servicio::where('id', '61')->first();
        $Tour10 = Servicio::where('id', '62')->first();
        $Tour11 = Servicio::where('id', '63')->first();
        $Tour12 = Servicio::where('id', '64')->first();
        $Tour13 = Servicio::where('id', '65')->first();
        $Tour14 = Servicio::where('id', '66')->first();
        $Tour15 = Servicio::where('id', '67')->first();
        $Tour16 = Servicio::where('id', '68')->first();
        $Tour17 = Servicio::where('id', '69')->first();
        $Tour18 = Servicio::where('id', '70')->first();
        $Tour19 = Servicio::where('id', '71')->first();
        $Tour20 = Servicio::where('id', '72')->first();
        $Tour21 = Servicio::where('id', '73')->first();
        $Tour22 = Servicio::where('id', '74')->first();

        //CITY TOUR LIMA
        $Tour1->incluyes()->attach(1);
        $Tour1->incluyes()->attach(2);
        $Tour1->incluyes()->attach(3);
        $Tour1->noincluyes()->attach(20);
        $Tour1->noincluyes()->attach(18);
        //ICA PARACAS HUACACHINA
        $Tour2->incluyes()->attach(1);
        $Tour2->incluyes()->attach(2);
        $Tour2->incluyes()->attach(3);
        $Tour2->incluyes()->attach(4);
        $Tour2->noincluyes()->attach(20);
        $Tour2->noincluyes()->attach(18);
        //ICA NAZCA SOBRE VUELO
        $Tour3->incluyes()->attach(9);
        $Tour3->incluyes()->attach(10);
        $Tour3->incluyes()->attach(11);
        $Tour3->incluyes()->attach(12);
        $Tour3->incluyes()->attach(13);
        $Tour3->incluyes()->attach(14);
        $Tour3->incluyes()->attach(15);
        $Tour3->incluyes()->attach(16);
        $Tour3->noincluyes()->attach(20);
        $Tour3->noincluyes()->attach(18);
        //CITY TOUR CUSCO
        $Tour4->incluyes()->attach(1);
        $Tour4->incluyes()->attach(2);
        $Tour4->incluyes()->attach(3);
        $Tour4->noincluyes()->attach(20);
        $Tour4->noincluyes()->attach(18);
        //MARAS MORAY
        $Tour5->incluyes()->attach(1);
        $Tour5->incluyes()->attach(2);
        $Tour5->incluyes()->attach(3);
        $Tour5->noincluyes()->attach(20);
        $Tour5->noincluyes()->attach(18);
        $Tour5->noincluyes()->attach(49);
        //MARAS MORAY CUATRIMOTO
        $Tour6->incluyes()->attach(1);
        $Tour6->incluyes()->attach(2);
        $Tour6->incluyes()->attach(3);
        $Tour6->incluyes()->attach(17);
        $Tour6->noincluyes()->attach(20);
        $Tour6->noincluyes()->attach(18);
        $Tour6->noincluyes()->attach(49);
        //MARAS LAGUNA HUAYPO CUATRIMOTO
        $Tour7->incluyes()->attach(1);
        $Tour7->incluyes()->attach(2);
        $Tour7->incluyes()->attach(3);
        $Tour7->incluyes()->attach(17);
        $Tour7->noincluyes()->attach(20);
        $Tour7->noincluyes()->attach(18);
        //MORADA DE LOS DIOSES

        $Tour8->noincluyes()->attach(20);
        $Tour8->noincluyes()->attach(18);
        //VALLE SUR
        $Tour9->incluyes()->attach(1);
        $Tour9->incluyes()->attach(2);
        $Tour9->incluyes()->attach(3);
        $Tour9->incluyes()->attach(4);
        $Tour9->noincluyes()->attach(20);
        //VALLE SAGRADO 3 LUGARES
        $Tour10->incluyes()->attach(1);
        $Tour10->incluyes()->attach(2);
        $Tour10->incluyes()->attach(3);
        $Tour10->incluyes()->attach(4);
        $Tour10->incluyes()->attach(19);
        $Tour10->noincluyes()->attach(20);
        //VALLE SAGRADO 5 LUGARES
        $Tour11->incluyes()->attach(1);
        $Tour11->incluyes()->attach(2);
        $Tour11->incluyes()->attach(3);
        $Tour11->incluyes()->attach(4);
        $Tour11->incluyes()->attach(19);
        $Tour11->noincluyes()->attach(20);
        //VINICUNCA O MONTAÑA DE 7 COLORES
        $Tour12->incluyes()->attach(1);
        $Tour12->incluyes()->attach(2);
        $Tour12->incluyes()->attach(3);
        $Tour12->incluyes()->attach(4);
        $Tour12->incluyes()->attach(19);
        $Tour12->incluyes()->attach(24);
        $Tour12->incluyes()->attach(25);
        //LAGUNA HUMANTAY
        $Tour13->incluyes()->attach(1);
        $Tour13->incluyes()->attach(2);
        $Tour13->incluyes()->attach(3);
        $Tour13->incluyes()->attach(4);
        $Tour13->incluyes()->attach(19);
        $Tour13->incluyes()->attach(24);
        $Tour13->incluyes()->attach(25);
        //MACHUPICCHU FULL DAY CON TREN EXPEDITION
        $Tour14->incluyes()->attach(1);
        $Tour14->incluyes()->attach(2);
        $Tour14->incluyes()->attach(3);
        $Tour14->incluyes()->attach(4);
        $Tour14->incluyes()->attach(26);
        $Tour14->incluyes()->attach(27);
        $Tour14->incluyes()->attach(28);
        $Tour14->incluyes()->attach(29);
        $Tour14->noincluyes()->attach(20);
        //Tren Observatorio / Retorno expedition
        $Tour15->incluyes()->attach(1);
        $Tour15->incluyes()->attach(2);
        $Tour15->incluyes()->attach(3);
        $Tour15->incluyes()->attach(4);
        $Tour15->incluyes()->attach(26);
        $Tour15->incluyes()->attach(27);
        $Tour15->incluyes()->attach(28);
        $Tour15->incluyes()->attach(29);
        $Tour15->incluyes()->attach(46);
        $Tour15->incluyes()->attach(47);
        $Tour15->incluyes()->attach(18);
        $Tour15->noincluyes()->attach(20);
        //Tren Observatorio / Retorno expedition
        $Tour16->incluyes()->attach(1);
        $Tour16->incluyes()->attach(2);
        $Tour16->incluyes()->attach(3);
        $Tour16->incluyes()->attach(4);
        $Tour16->incluyes()->attach(26);
        $Tour16->incluyes()->attach(27);
        $Tour16->incluyes()->attach(28);
        $Tour16->incluyes()->attach(29);
        $Tour16->incluyes()->attach(46);
        $Tour16->incluyes()->attach(47);
        $Tour16->noincluyes()->attach(20);
        //PICNIC MARAS
        $Tour17->incluyes()->attach(2);
        $Tour17->incluyes()->attach(30);
        $Tour17->incluyes()->attach(31);
        $Tour17->incluyes()->attach(32);
        $Tour17->incluyes()->attach(33);
        $Tour17->incluyes()->attach(34);
        $Tour17->incluyes()->attach(35);
        $Tour17->noincluyes()->attach(20);
        $Tour17->noincluyes()->attach(18);
        //BUGGIES EN HUAYPO
        $Tour18->incluyes()->attach(2);
        $Tour18->incluyes()->attach(4);
        $Tour18->incluyes()->attach(36);
        $Tour18->incluyes()->attach(37);
        $Tour18->incluyes()->attach(38);
        $Tour18->incluyes()->attach(39);
        $Tour18->noincluyes()->attach(20);
        $Tour18->noincluyes()->attach(18);
        //TALLER DE PINTURA DE TOROS
        $Tour19->incluyes()->attach(40);
        $Tour19->incluyes()->attach(34);
        $Tour19->incluyes()->attach(14);
        $Tour19->incluyes()->attach(41);
        $Tour19->noincluyes()->attach(20);
        $Tour19->noincluyes()->attach(18);
        //QESWACHAKA
        $Tour20->incluyes()->attach(2);
        $Tour20->incluyes()->attach(4);
        $Tour20->incluyes()->attach(18);
        $Tour20->incluyes()->attach(20);
        $Tour20->incluyes()->attach(22);
        //PUNO 1 DIA
        $Tour21->incluyes()->attach(46);
        $Tour21->incluyes()->attach(47);
        $Tour21->incluyes()->attach(20);
        $Tour21->incluyes()->attach(2);
        $Tour21->incluyes()->attach(4);
        $Tour21->incluyes()->attach(43);
        $Tour21->incluyes()->attach(44);
        $Tour21->incluyes()->attach(18);
        $Tour21->incluyes()->attach(3);
        //PUNO 2 DIA
        $Tour22->incluyes()->attach(46);
        $Tour22->incluyes()->attach(47);
        $Tour22->incluyes()->attach(20);
        $Tour22->incluyes()->attach(2);
        $Tour22->incluyes()->attach(4);
        $Tour22->incluyes()->attach(43);
        $Tour22->incluyes()->attach(44);
        $Tour22->incluyes()->attach(18);
        $Tour22->incluyes()->attach(3);
        $Tour22->incluyes()->attach(22);
        $Tour22->incluyes()->attach(45);
        $Tour22->incluyes()->attach(14);

        foreach ($hoteles as $elemento) {
            Servicio::create([
                'titulo'        => $elemento,
                'categoria_id'  => 2,
            ]);
        }

        $Hotel1 = Servicio::where('id', '75')->first();
        $Hotel2 = Servicio::where('id', '76')->first();
        $Hotel3 = Servicio::where('id', '77')->first();
        $Hotel4 = Servicio::where('id', '78')->first();
        $Hotel5 = Servicio::where('id', '79')->first();
        $Hotel6 = Servicio::where('id', '80')->first();
        $Hotel7 = Servicio::where('id', '81')->first();
        $Hotel8 = Servicio::where('id', '82')->first();

        $Hotel1->incluyes()->attach(20);
        $Hotel1->incluyes()->attach(18);
        $Hotel1->incluyes()->attach(22);

        $Hotel2->incluyes()->attach(20);
        $Hotel2->incluyes()->attach(18);
        $Hotel2->incluyes()->attach(22);

        $Hotel3->incluyes()->attach(20);
        $Hotel3->incluyes()->attach(18);
        $Hotel3->incluyes()->attach(22);

        $Hotel4->incluyes()->attach(20);
        $Hotel4->incluyes()->attach(18);
        $Hotel4->incluyes()->attach(22);

        $Hotel5->incluyes()->attach(20);
        $Hotel5->incluyes()->attach(18);
        $Hotel5->incluyes()->attach(22);

        $Hotel6->incluyes()->attach(20);
        $Hotel6->incluyes()->attach(18);
        $Hotel6->incluyes()->attach(22);

        $Hotel7->incluyes()->attach(20);
        $Hotel7->incluyes()->attach(18);
        $Hotel7->incluyes()->attach(22);

        $Hotel8->incluyes()->attach(20);
        $Hotel8->incluyes()->attach(18);
        $Hotel8->incluyes()->attach(22);

        foreach ($vuelos as $elemento) {
            Servicio::create([
                'titulo'        => $elemento,
                'categoria_id'  => 3,
            ]);
        }
        foreach ($detallesvuelos as $elemento) {
            Servicio::create([
                'titulo'        => $elemento,
                'categoria_id'  => 6,
            ]);
        }

        $Vuelo1 = Servicio::where('id', '83')->first();
        $Vuelo2 = Servicio::where('id', '84')->first();
        $Vuelo3 = Servicio::where('id', '85')->first();
        $Vuelo4 = Servicio::where('id', '86')->first();
        $Vuelo5 = Servicio::where('id', '87')->first();
        $Vuelo6 = Servicio::where('id', '88')->first();

        $Vuelo1->incluyes()->attach(1);
        $Vuelo2->incluyes()->attach(1);
        $Vuelo3->incluyes()->attach(1);
        $Vuelo4->incluyes()->attach(1);
        $Vuelo5->incluyes()->attach(1);
        $Vuelo6->incluyes()->attach(1);
    }
}
