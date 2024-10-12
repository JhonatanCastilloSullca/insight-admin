<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;


class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
            [1,'Afganistán','AF',69,'Afghan'],
            [2,'Islas Åland','AX',134,'Åland Islander'],
            [3,'Albania','AL',135,'Albanian'],
            [4,'Argelia','DZ',48,'Algerian'],
            [5,'Estados Unidos','US',207,'American'],
            [6,'Andorra','AD',137,'Andorran'],
            [7,'Angola','AO',41,'Angolan'],
            [8,'Anguila','AI',213,'Anguillian'],
            [9,'Antártida','AQ',214,'Antarctican'],
            [10,'Antigua y Barbuda','AG',208,'Antiguan and Barbudan'],
            [11,'Antillas Holandesas','AN',119,'Antillean'],
            [12,'Argentina','AR',212,'Argentinian'],
            [13,'Armenia','AM',182,'Armenian'],
            [14,'Aruba','AW',217,'Aruban'],
            [15,'Australia','AU',90,'Australian'],
            [16,'Austria','AT',139,'Austrian'],
            [17,'Azerbaiyán','AZ',185,'Azerbaijani'],
            [18,'Bahamas','BS',204,'Bahamian'],
            [19,'Baréin','BH',183,'Bahraini'],
            [20,'Bangladés','BD',70,'Bangladeshi'],
            [21,'Barbados','BB',205,'Barbadian'],
            [22,'Lesoto','LS',8,'Basotho'],
            [23,'Bielorrusia','BY',136,'Belarusian'],
            [24,'Bélgica','BE',138,'Belgian'],
            [25,'Belice','BZ',113,'Belizean'],
            [26,'Benín','BJ',42,'Beninese'],
            [27,'Bermudas','BM',202,'Bermudian'],
            [28,'Bután','BT',56,'Bhutanese'],
            [29,'Bolivia','BO',218,'Bolivian'],
            [30,'Bosnia y Herzegovina','BA',143,'Bosnian'],
            [31,'Botsuana','BW',44,'Botswanan'],
            [32,'Isla Bouvet','BV',110,'Bouvet Island'],
            [33,'Brasil','BR',215,'Brazilian'],
            [34,'Reino Unido','GB',1,'British'],
            [35,'Territorio Británico del Océano Índico','IO',62,'British Indian Ocean'],
            [36,'Brunéi','BN',61,'Bruneian'],
            [37,'Bulgaria','BG',144,'Bulgarian'],
            [38,'Burkina Faso','BF',52,'Burkinabe'],
            [39,'Birmania','MM',76,'Burmese'],
            [40,'Burundi','BI',45,'Burundian'],
            [41,'Camboya','KH',72,'Cambodian'],
            [42,'Camerún','CM',49,'Cameroonian'],
            [43,'Canadá','CA',203,'Canadian'],
            [44,'Cabo Verde','CV',51,'Cape Verdean'],
            [45,'Islas Caimán','KY',107,'Caymanian'],
            [46,'República Centroafricana','CF',53,'Central African'],
            [47,'Chad','TD',50,'Chadian'],
            [48,'Islas del Canal','JE',151,'Channel Islander'],
            [49,'Chile','CL',210,'Chilean'],
            [50,'China','CN',77,'Chinese'],
            [51,'Isla de Navidad','CX',63,'Christmas Islander'],
            [52,'Islas Cocos','CC',81,'Cocos Islander'],
            [53,'Colombia','CO',216,'Colombian'],
            [54,'Comoras','KM',43,'Comorian'],
            [55,'Congo','CG',46,'Congolese'],
            [56,'Islas Cook','CK',88,'Cook Islander'],
            [57,'Costa Rica','CR',112,'Costa Rican'],
            [58,'Croacia','HR',147,'Croatian'],
            [59,'Cuba','CU',108,'Cuban'],
            [60,'Chipre','CY',146,'Cypriot'],
            [61,'República Checa','CZ',148,'Czech'],
            [62,'Dinamarca','DK',153,'Danish'],
            [63,'Yibuti','DJ',236,'Djiboutian'],
            [64,'Dominica','DM',106,'Dominican'],
            [65,'Timor Oriental','TL',85,'East Timorese'],
            [66,'Ecuador','EC',211,'Ecuadorian'],
            [67,'Egipto','EG',54,'Egyptian'],
            [68,'Emiratos Árabes Unidos','AE',199,'Emiratis'],
            [69,'Guinea Ecuatorial','GQ',219,'Equatoguinean'],
            [70,'Eritrea','ER',40,'Eritrean'],
            [71,'Estonia','EE',157,'Estonian'],
            [72,'Etiopía','ET',39,'Ethiopian'],
            [73,'Islas Malvinas','FK',220,'Falkland Islander'],
            [74,'Islas Feroe','FO',141,'Faroese'],
            [75,'Fiyi','FJ',89,'Fijian'],
            [76,'Filipinas','PH',79,'Filipino'],
            [77,'Finlandia','FI',142,'Finnish'],
            [78,'Francia','FR',125,'French'],
            [79,'Polinesia Francesa','PF',104,'French Polynesian'],
            [80,'Gabón','GA',4,'Gabonese'],
            [81,'Gambia','GM',37,'Gambian'],
            [82,'Georgia','GE',184,'Georgian'],
            [83,'Alemania','DE',145,'German'],
            [84,'Ghana','GH',7,'Ghanaian'],
            [85,'Gibraltar','GI',149,'Gibraltarian'],
            [86,'Grecia','GR',150,'Greek'],
            [87,'Groenlandia','GL',209,'Greenlandic'],
            [88,'Granada','GD',222,'Grenadian'],
            [89,'Guadalupe','GP',223,'Guadeloupean'],
            [90,'Guam','GU',224,'Guamanian'],
            [91,'Guatemala','GT',111,'Guatemalan'],
            [92,'Guyana','GY',221,'Guianese'],
            [93,'Guinea-Bisáu','GW',3,'Guinea-Bissau national'],
            [94,'Guinea','GN',38,'Guinean'],
            [95,'Guyana','GY',226,'Guyanese'],
            [96,'Haití','HT',114,'Haitian'],
            [97,'Islas Heard y McDonald','HM',115,'Heard and McDonald Island'],
            [98,'Honduras','HN',116,'Honduran'],
            [99,'Hong Kong','HK',64,'Hong Kong Chinese'],
            [100,'Hungría','HU',152,'Hungarian'],
            [101,'Islandia','IS',154,'Icelandic'],
            [102,'Kiribati','KI',92,'I-Kiribati'],
            [103,'India','IN',65,'Indian'],
            [104,'Indonesia','ID',66,'Indonesian'],
            [105,'Irán','IR',59,'Iranian'],
            [106,'Irak','IQ',67,'Iraqi'],
            [107,'Irlanda','IE',155,'Irish'],
            [108,'Israel','IL',186,'Israeli'],
            [109,'Italia','IT',156,'Italian'],
            [110,'Costa de Marfil','CI',6,'Ivorian'],
            [111,'Jamaica','JM',105,'Jamaican'],
            [112,'Japón','JP',55,'Japanese'],
            [113,'Jordania','JO',188,'Jordanian'],
            [114,'Kazajistán','KZ',193,'Kazakh'],
            [115,'Kenia','KE',5,'Kenyan'],
            [116,'Kuwait','KW',189,'Kuwaiti'],
            [117,'Kirguistán','KG',190,'Kyrgyz'],
            [118,'Laos','LA',73,'Lao'],
            [119,'Letonia','LV',158,'Latvian'],
            [120,'Líbano','LB',187,'Lebanese'],
            [121,'Liberia','LR',9,'Liberian'],
            [122,'Libia','LY',11,'Libyan'],
            [123,'Liechtenstein','LI',159,'Liechtensteiner'],
            [124,'Lituania','LT',160,'Lithuanian'],
            [125,'Luxemburgo','LU',162,'Luxembourgish'],
            [126,'Macao','MO',74,'Macanese'],
            [127,'Macedonia del Norte','MK',166,'Macedonian'],
            [128,'Mayotte','YT',118,'Mahorais'],
            [129,'Madagascar','MG',14,'Malagasy'],
            [130,'Malaui','MW',15,'Malawian'],
            [131,'Malasia','MY',82,'Malaysian'],
            [132,'Maldivas','MV',58,'Maldivian'],
            [133,'Malí','ML',23,'Malian'],
            [134,'Malta','MT',167,'Maltese'],
            [135,'Islas Marshall','MH',225,'Marshallese'],
            [136,'Martinica','MQ',117,'Martinican'],
            [137,'Mauritania','MR',16,'Mauritanian'],
            [138,'Mauricio','MU',17,'Mauritian'],
            [139,'México','MX',206,'Mexican'],
            [140,'Micronesia','FM',91,'Micronesian'],
            [141,'Moldavia','MD',161,'Moldovan'],
            [142,'Mónaco','MC',168,'Monegasque'],
            [143,'Mongolia','MN',68,'Mongolian'],
            [144,'Montenegro','ME',163,'Montenegrian'],
            [145,'Montserrat','MS',122,'Montserratian'],
            [146,'Marruecos','MA',20,'Moroccan'],
            [147,'Mozambique','MZ',21,'Mozambican'],
            [148,'Namibia','NA',19,'Namibian'],
            [149,'Nauru','NR',94,'Nauruan'],
            [150,'Nepal','NP',80,'Nepalese'],
            [151,'Países Bajos','NL',164,'Netherlander'],
            [152,'Nueva Caledonia','NC',93,'New Caledonian'],
            [153,'Nueva Zelanda','NZ',99,'New Zealander'],
            [154,'Nicaragua','NI',120,'Nicaraguan'],
            [155,'Nigeria','NG',25,'Nigerian'],
            [156,'Níger','NE',34,'Nigerien'],
            [157,'Niue','NU',95,'Niuean'],
            [158,'Ninguno','N1',235,'None'],
            [159,'Isla Norfolk','NF',228,'Norfolk Islander'],
            [160,'Corea del Norte','KP',71,'North Korean'],
            [161,'Islas Marianas del Norte','MP',57,'Northern Mariana Islander'],
            [162,'Noruega','NO',165,'Norwegian'],
            [163,'Omán','OM',192,'Omani'],
            [164,'Omán','OT',234,'Otros'],
            [165,'Pakistán','PK',60,'Pakistani'],
            [166,'Palaos','PW',96,'Palauan'],
            [167,'Palestina','PS',196,'Palestinian'],
            [168,'Panamá','PA',123,'Panamanian'],
            [169,'Papúa Nueva Guinea','PG',97,'Papua New Guinean'],
            [170,'Paraguay','PY',229,'Paraguayan'],
            [171,'Perú','PE',230,'Peruvian'],
            [172,'Islas Pitcairn','PN',103,'Pitcairn Islander'],
            [173,'Polonia','PL',140,'Polish'],
            [174,'Portugal','PT',169,'Portuguese'],
            [175,'Puerto Rico','PR',121,'Puerto Rican'],
            [176,'Catar','QA',195,'Qatari'],
            [177,'Reunión','RE',124,'Reunionese'],
            [178,'Rumania','RO',171,'Romanian'],
            [179,'Rusia','RU',170,'Russian'],
            [180,'Ruanda','RW',24,'Rwandan'],
            [181,'Sáhara Occidental','EH',36,'Sahrawi'],
            [182,'Santa Elena','SH',126,'Saint Helenian'],
            [183,'San Cristóbal y Nieves','KN',131,'Saint Kitts and Nevis'],
            [184,'Santa Lucía','LC',130,'Saint Lucian'],
            [185,'San Pedro y Miquelón','PM',127,'Saint Pierre and Miquelon'],
            [186,'El Salvador','SV',109,'Salvadoran'],
            [187,'San Marino','SM',174,'Sammarinese'],
            [188,'Santo Tomé y Príncipe','ST',128,'São Toméan'],
            [189,'Arabia Saudita','SA',194,'Saudi Arabian'],
            [190,'Senegal','SN',30,'Senegalese'],
            [191,'Serbia','RS',172,'Serbian'],
            [192,'Seychelles','SC',10,'Seychellois'],
            [193,'Sierra Leona','SL',12,'Sierra Leonean'],
            [194,'Singapur','SG',75,'Singaporean'],
            [195,'Eslovaquia','SK',173,'Slovak'],
            [196,'Eslovenia','SI',175,'Slovene'],
            [197,'Islas Salomón','SB',101,'Solomon Islander'],
            [198,'Somalia','SO',28,'Somali'],
            [199,'Sudáfrica','ZA',13,'South African'],
            [200,'Corea del Sur','KR',78,'South Korean'],
            [201,'España','ES',176,'Spanish'],
            [202,'Sri Lanka','LK',83,'Sri Lankan'],
            [203,'Sudán','SD',35,'Sudanese'],
            [204,'Surinam','SR',231,'Surinamese'],
            [205,'Svalbard y Jan Mayen','SJ',178,'Svalbard and Jan Mayen'],
            [206,'Esuatini','SZ',18,'Swazi'],
            [207,'Suecia','SE',177,'Swedish'],
            [208,'Suiza','CH',179,'Swiss'],
            [209,'Siria','SY',197,'Syrian'],
            [210,'Taiwán','TW',86,'Taiwanese'],
            [211,'Tayikistán','TJ',198,'Tajik'],
            [212,'Tanzania','TZ',26,'Tanzanian'],
            [213,'Tailandia','TH',84,'Thai'],
            [214,'Togo','TG',22,'Togolese'],
            [215,'Tokelau','TK',100,'Tokelauan'],
            [216,'Tonga','TO',98,'Tongan'],
            [217,'Trinidad y Tobago','TT',132,'Trinidadian & Tobagonian'],
            [218,'Túnez','TN',27,'Tunisian'],
            [219,'Turquía','TR',180,'Turkish'],
            [220,'Turkmenistán','TM',191,'Turkmen'],
            [221,'Islas Turcas y Caicos','TC',227,'Turks and Caicos Islander'],
            [222,'Tuvalu','TV',102,'Tuvaluan'],
            [223,'Uganda','UG',29,'Ugandan'],
            [224,'Ucrania','UA',181,'Ukrainian'],
            [225,'Uruguay','UY',232,'Uruguayan'],
            [226,'Uzbekistán','UZ',200,'Uzbek'],
            [227,'Ciudad del Vaticano','VA',133,'Vatican'],
            [228,'Venezuela','VE',233,'Venezuelan'],
            [229,'Vietnam','VN',87,'Vietnamese'],
            [230,'San Vicente y las Granadinas','VC',129,'Vincentian'],
            [231,'Yemen','YE',201,'Yemeni'],
            [232,'Zaire','CD',31,'Zaïrean'],
            [233,'Zambia','ZM',32,'Zambian'],
            [234,'Zimbabue','ZW',33,'Zimbabwean'],
        ];

        foreach ($datos as $dato) {
            Pais::create([
                'id' => $dato[0],
                'iso' => $dato[2],
                'nombre' => $dato[1],
                'code' => $dato[3],
                'text' => $dato[4],
            ]);
        }
    }
}
