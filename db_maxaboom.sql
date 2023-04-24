CREATE DATABASE IF NOT EXISTS db_maxaboom;

/*------------------users table----------------*/
CREATE TABLE users 
(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname varchar(100),
    lastname varchar(100),
    mail varchar(100),
    password varchar(255),
    dob date,
    created_at datetime,
    user_role varchar(100)
);


INSERT INTO users (firstname, lastname, mail, password, dob, created_at, user_role)
 VALUES
 ('Rebecca', 'Armand', 'armand_lebeau@gmail.com',PASSWORD('azerty'), '1973-11-17',"2023-01-01 12:12:12", 'customer'),
 ('Aymee', 'Hebert', 'vieilhomme@yahoo.fr',PASSWORD('azerty'), '1979-11-18',"2023-01-01 12:12:12",'customer'),
 ('Marielle', 'Ribeiro', 'mari123@gmail.com',PASSWORD('azerty'), '1983-01-31',"2023-01-01 12:12:12",'customer'),
 ('Hilaire', 'Savary', 'hilaire.savary@gmail.com',PASSWORD('azerty'), '2001-10-07',"2023-01-01 12:12:12",'customer');

 /*------------------address table----------------*/
CREATE TABLE addresses
(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titre varchar(100),
    address varchar(100),
    address_complement varchar(100),
    postal_code int,
    city varchar(100),
    country varchar(100),
    user_id int,
    type varchar(100)
);

INSERT INTO addresses (titre, address, address_complement, postal_code, city, country, user_id, type)
 VALUES
 ('Maison', '02 rue de la fontaine', '5e batiment', '13001', 'Marseille', 'FRANCE', 1, 'livraison'),
 ('Boulot', '69 rue Camas', '', '13006', 'Marseille', 'FRANCE', 2, 'livraison'),
 ('Maison', '155 rue des Rois', '', '51100', 'Reims', 'FRANCE', 3, 'facturation'),
 ('Boulot', '155 rue des Rois', '', '51100', 'Reims', 'FRANCE', 3, 'livraison'),
 ('Maison', '67 rue Dudev', '4e batiment', '13002', 'Marseille', 'FRANCE', 4, 'livraison');


/*-------------------categories tables----------*/
/*-------------------categories tables----------*/
CREATE TABLE categories(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titre varchar(100),
    name varchar(100)
);

 INSERT INTO categories (titre, name)
 VALUES
 ('pianos', 'pianos'),
 ('guitares', 'guitars'),
 ('percussions', 'percussion'),
 ('lutherie', 'violin'),
 ('dj', 'dj'),
 ('vents', 'wind-instruments');

 /*-------------------sub_categories tables----------*/


 CREATE TABLE sub_categories(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titre varchar(100),
    name varchar(100),
    category_id int
);

 INSERT INTO sub_categories (titre, name, category_id)
 VALUES
 ('pianos droits', 'upright-piano', 1),
 ('pianos à queue', 'grand-piano', 1),
 ('pianos numériques', 'digital-piano', 1),
 ('synthetiseurs', 'synthesizer', 1),
 ('guitares', 'guitars', 2),
 ('basse', 'bass-guitar', 2),
 ('guitare electrique', 'electric-guitar', 2),
 ('ampli guitare', 'guitar-amp', 2),
 ('batteries', 'battery', 3),
 ('cymbales', 'cymbals', 3),
 ('tambours et autres', 'drums-and-others', 3),
 ('violon', 'violin', 4),
 ('contrebasse', 'bass', 4),
 ('accessoires de violon', 'violin-accessory', 4),
 ('platines', 'turntable', 5),
 ('boîte à rythme', 'drum-machines', 5),
 ('accessoires DJ', 'dj-accessories', 5),
 ('saxophones', 'saxophone', 6),
 ('flutes', 'flute', 6),
 ('trompettes', 'trumpet', 6),
 ('gros cuivres','big-brass-instrument', 6);

 /*-------------------products tables----------*/
 CREATE TABLE products(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(100),
    description text,
    price int,
    categories_id int,
    sub_categories_id int,
    image varchar(255),
    created_at datetime,
    update_at datetime,
    stock int,
    deleted_at datetime
 );

 INSERT INTO products (name, description, price, categories_id,
 sub_categories_id, image, created_at, update_at, stock, deleted_at)
 VALUES
 ('Piano Yamaha SE 132',"Dans le cadre d’une collaboration unique entre l’Est et l’Ouest, la série SE combine la précision unique, qui a rendu Yamaha si renommée, à l’inspiration et la chaleur héritées de la musique européenne. Combinant le savoir-faire ou l’expertise d’artistes, techniciens et artisans européens, la série SE Yamaha est conçue pour répondre à toutes les exigences d’un piano très haut de gamme.",
 2270000, 1,1,'img_1.png', "2023-01-01 12:12:12", null,1, null),
 ('Piano Yamaha-B1',"Le B1 s’impose par la qualité de sa fabrication et de sa mécanique, par ses qualités musicales remarquables à ce niveau de gamme, et surtout par son rapport qualité/prix tout à fait exceptionnel.",
 397000, 1,1,'img_2.png', "2023-01-01 12:12:12", null,2, null),
 ('Piano Johannes Seiler-114 Modern',"Piano droit noir brillant de la gamme Johannes Seiler.",
 64000, 1,1,'img_3.png', "2023-01-01 12:12:00", null,2, null),
 ('Piano Johannes Seiler-Konsole',"Piano droit noir Konsole, élégant et raffiné, de la gamme Johannes Seiler. Un choix aussi étendu qu'individuel est assuré par les multiples possibilités de placages en bois précieux. Cet instrument au jeu délicat et doté d'une mécanique élaborée suivra vos exigences musicales des années durant.",
 1562800, 1,1,'img_4.png', "2023-01-01 12:12:00", null,1, null),
 ('Piano Samicks JS 043D',"Premier modèle de la gamme des pianos droits, ce petit piano d'étude démontre toutes les qualités de savoir-faire de la marque coréenne fabriqué en Indonésie",
 359000, 1,1,'img_5.png', "2023-01-01 12:12:00", null,4,null),
 ('Piano Kawaï GL50',"Piano à queue de 188 cm de longueur équipé d'un table d'harmonie en épicéa doté d'une finition sobre et élégante. Les pianos de la série GL sont dotés d'une résistance remarquable et permettent une utilisation à long terme. Ce piano de qualité Japonaise, vous permettra d'explorer tout les styles de musique.",
 2649000, 1,2,'img_6.png', "2023-01-01 12:12:00", null,1, null),
 ('Piano Kawaï GX1', "Le KAWAI GX-1 propose un niveau d'élégance et un artisanat impressionnant pour un piano de cette taille (1m66)",
 2519000, 1,2,'img_7.png', "2023-01-01 12:12:05", null,0, null),
 ('Piano numérique Yamaha-P45', "Son design élégant et ses qualités pianistiques font du Yamaha P-45 la référence incontournable des pianos numériques portables.",
 43900, 1,3,'img_8.png', "2023-01-01 12:12:05", null,6, null),
 ('Piano numérique Woodbrass XP2 WH', "Le piano numérique XP2 va satisfaire les musiciens recherchant un toucher lourd réaliste, un bon son de piano et des fonctions essentielles pour le perfectionnement et l'apprentissage telle que le Bluetooth, une première sur un piano aussi compétitif.",
 37900, 1,3,'img_9.png', "2023-01-01 12:12:05", null,4, null),
 ('Synthétiseur Arturia Minifreak', "Les moteurs sonores numériques jumeaux du MiniFreak proposent plus de 20 modes et
peuvent être utilisés individuellement, empilés ou peut traiter la sortie de l'autre pour un
comportement sonore complexe unique. Ses 6 voix numériques entrent ensuite en collision
avec des filtres analogiques polyphoniques, équilibrant la netteté numérique avec une
réponse analogique riche.",
 59900, 1,4,'img_10.png', "2023-01-01 12:12:05", null,2, null),
 ('Synthétiseur Novation Mininova', "Le Novation MiniNova est un synthétiseur étonnamment puissant au format très compact. Il dispose de fonctionnalités innovantes très performantes, notamment des pads d'animation de motifs.",
 37900, 1,4,'img_11.png', "2023-01-01 12:12:05", null,3, null),
 ('Guitare Ortega R121',"Guitare classiques 1/4, table d'harmonie en épicéa, corps en acajou, manche en acajou, touche en noyer, diapason de 438 mm",
 14700, 2,5,'img_12.png', "2023-01-01 12:12:12", null,5, null),
 ('Guitare J&D classique',"1/4 guitare classique, table : épicéa, laminé, manche : acajou, largeur de sillet : 40 mm. Avec la guitare classique CG-1 1/4 NT Natural 1/4, J & D propose une guitare d'entrée de gamme tout en prêtant attention à la jouabilité et au confort. ",
 6700, 2,5,'img_13.png', "2023-01-01 12:12:12", null,7, null),
 ('Guitare Takamine GD11M-NS NATURAL',"Grâce à ses rencontres avec des artistes du monde entier, Takamine réalise depuis cinquante ans des guitares à la qualité reconnue. Notamment cette série G qui présente un vaste choix de modèles, de la dreadnought acoustique à la jumbo électroacoustique 12-cordes, à des prix accessibles à tous.",
 23500, 2,5,'img_14.png', "2023-01-01 12:12:12", null,3, null),
 ('Guitare Eagletone Hobo Koa'," La guitare de voyage Eagletone HOBO s'adapte à toutes les situations et tous les environnements, et vous accompagne où que vous alliez !",
 15900, 2,5,'img_15.png', "2023-01-01 12:12:12", null,2, null),
 ('Basse Woodbrass MBP100',"Pour répondre aux bassistes débutants, Woodbrass propose la MPB100 : profil du manche adapté à l'apprentissage, corps léger et confortable assis comme debout, électronique simple mais efficace.",
 16900, 2,6,'img_16.png', "2023-01-01 12:12:12", null,2, null),
 ('Basse Eagletone MBA100 ',"La basse Eagletone MBA100 offre un manche au profil généreux mais confortable idéal pour l'apprentissage, un corps ergonomique, une électronique active et une surprenante polyvalence.",
 14900, 2,6,'img_17.png', "2023-01-01 12:12:12", null,4, null),
 ('Basse Sterling by Music man',"Avec la Ray4, Sterling démocratise la philosophie Music Man et offre un instrument au rapport qualité/prix exceptionnel qui fera le bonheur des débutants comme des bassistes confirmés.",
 48900, 2,6,'img_18.png', "2023-01-01 12:12:12", null,2, null),
 ('Guitare électrique Ibanez - RG370AHMZ-BMT',"Avec son tyle et son corps en frêne, la Ibanez est une très bonne guitare moyen de gamme ! Micro SHS pour un meilleur rendu son",
 56900, 2,7,'img_19.png', "2023-01-01 12:12:12", null,2, null),
 ('Guitare électrique LTS Guitars',"'EC-256 black bénéficie de toute la maîtrise technique des employés de l'usine LTD. Avec cette guitare puissante et polyvalente, faites « banger » la foule !",
 51900, 2,7,'img_20.png', "2023-01-01 12:12:12", null,2, null),
 ('Guitare électrique Epiphone',"Les modèles Les Paul™ Standard 60s de la nouvelle collection Inspired by Gibson™ d'Epiphone recréent le son des Les Paul des années 1960. Elle est dotée d'un corps classique en acajou ",
 52900, 2,7,'img_21.png', "2023-01-01 12:12:12", null,3, null),
  ('Ampli Marshall CODE 25',"nouvelle génération d'amplificateurs Marshall. Entièrement programmable, le code associe une modélisation authentique des tonalités marshall classiques et contemporaines à une fx de qualité professionnelle. ",
 18500, 2,8,'img_22.png', "2023-01-01 12:12:12", null,9, null),
 ('Ampli Yamaha THR10II 20W',"Yamaha est à l'origine des amplificateurs nomades qui ont révolutionné la pratique de la guitare en dehors de la scène ou du studio.",
 34900, 2,8,'img_23.png', "2023-01-01 12:12:12", null,3, null),
 ('Batterie Gretch Drums',"Dès son lancement au début des années 2000, la série Catalina Club est rapidement devenue une des meilleures ventes. La série combine des configurations traditionnelles et un son classique avec un hardware au design élégant et moderne. Des fûts en acajou à 7 plis produisent des sons chauds et percutants de style vintage.",
 77700, 3,9,'img_24.png', "2023-01-01 12:12:12", null,2, null),
 ('Batterie Sonor  AQX JAZZ',"Avec les kits AQX, SONOR a réuni tout ce dont un batteur débutant peut avoir besoins dans son set : Des fûts au son exceptionnel, un hardware efficace et solide et une caisse claire polyvalente. Mais cela ne s'est pas arrêté là. Avec les kits compacts AQX, des kits de fûts de taille réduite sont également proposés tels que ce kit Jazz",
 67900, 3,9,'img_25.png', "2023-01-01 12:12:12", null,1, null),
 ('Batterie Bird DS102J BK',"Bird propose la batterie DS102J BK, le kit complet pour les petits budgets, et les petites tailles. Tout ce qu'il faut pour que les plus jeunes puissent s'initier à la batterie sans se ruiner.",
 14900, 3,9,'img_26.png', "2023-01-01 12:12:12", null,8, null),
 ('Batterie Rock Pearl President Phenolic',"Véritable témoignage de l'odysse de 75 ans de Pearl en matière de qualité et de progrès des batteries, les fûts Pearl President Deluxe sont une version moderne d'un modèle bien connu. La série President Deluxe fait revivre la saveur unique et sombre des fûts en lauan (acajou plus lger) pour une expérience de jeu traditionnellement pleine et contrôle.",
 199900, 3,9,'img_27.png', "2023-01-01 12:12:12", null,2, null),
 ('Cymbales Sabian',"Répondant à la demande de cymbales de qualité pour tous les budgets, SABIAN introduit SBr pour offrir de la qualité aux batteurs novices. ",
 8800, 3,10,'img_28.png', "2023-01-01 12:12:12", null,12, null),
 ('Cymbales Zildjian K0965',"Une sublime cymbale ride 20 pouces, à la sonorité dark et aux harmoniques rondes et chaudes.",
 40900, 3,10,'img_29.png', "2023-01-01 12:12:12", null,11, null),
 ('Handpan Rav Vast drum',"Le RAV Drum émet des sons véritablement hypnotiques. Parmi toutes les percussions et handpans, c'est le seul qui possède une harmonisation complète de 4 à 7 tons sur chaque langue.",
 100900, 3,11,'img_30.png', "2023-01-01 12:12:12", null,8, null),
 ('Handpan Sonic Energy Drum',"Le Meinl Sonic Energy Octave Steel Tongue Drum est fabriqué en acier inoxydable de haute qualité. Il possède une note basse centrale au milieu et huit autres notes autour. Ces huit notes sont composées de deux lamelles chacune qui délivrent la note sur deux octaves. Cela crée un son magnifique et méditatif.",
 42900, 3,11,'img_31.png', "2023-01-01 12:12:12", null,11, null),
 ('Djembes Wassoulou',"Ces djembés sont de forme traditionnelle, parfaitement équilibrés (géométrie et poids). La table d'harmonie (zone de contact avec les mains) est arrondie ce qui garantis le confort de jeu, le pied est chanfreiné.",
 18900, 3,11,'img_32.png', "2023-01-01 12:12:12", null,7, null),
 ('Djembes Tanga',"La finition de ces Djembés est irréprochable. Sa fabrication à la main lui fait bénéficier d'un son de qualité avec un large spectre sonore, mais également d'un esthétisme terriblement efficace.",
 20900, 3,11,'img_33.png', "2023-01-01 12:12:12", null,5, null),
 ('Kalimba Sonic Energy',"Le Meinl Sonic Energy Soundhole Kalimba (parfois appelé Thumb Piano) est un instrument mélodique à la sonorité douce qui remplit l'espace autour de vous de sons éthérés lorsque vous pincez les notes. Ce kalimba possède 17 touches en acier (dents) sur la gamme de do majeur.",
 7900, 3,11,'img_34.png', "2023-01-01 12:12:12", null,17, null),
 ('Violoncelle Stentor 2 4/4',"Reconnu comme un violoncelle d'excellent rapport qualité/prix, le violoncelle Stentor Student II est entièrement massif. Sa touche et ses chevilles en ébène, ainsi que son cordier équip&eacute de quatre tendeurs permettront aux débutants d'apprendre le violoncelle sur un instrument qui a tout d'un grand.",
 112500, 4,12,'img_35.png', "2023-01-01 12:12:12", null,4, null),
 ('Violoncelle Glica Genial',"Violoncelle fabriqué à partir d'érable et d'épicéa a très bonne résonance des Carpates. Tous les accessoires sont en ébène. Vernis à l'huile à la main. Excellent rapport qualité prix !",
 199900, 4,12,'img_36.png', "2023-01-01 12:12:12", null,3, null),
 ('Alto Primavera',"Découvrez nos instruments à cordes frottées adaptés pour les altistes débutants. Sa forme s’accommode aux musiciens adultes de grande taille avec une longueur du bras de 67 cm et plus. Idéal pour les premières années d’apprentissage d’alto. Son succès auprès des écoles de musique repose sur son excellent rapport qualité/prix.",
 29900, 4,12,'img_37.png', "2023-01-01 12:12:12", null,6, null),
 ('Alto Gems',"Le meilleur choix pour les étudiants avancés. Très bon alto d'étude. Il est fabriqué à partir d'érable légèrement ondé et d'épicéa des Carpates séchés naturellement.",
 69900, 4,12,'img_38.png', "2023-01-01 12:12:12", null,3, null),
 ('Contrebasse Rockabilly Gewa',"Cette contrebasse de la marque Gewa a tout pour elle : sa forme gambe, sa touche en ébène large, sa finition noire satinée avec bords blancs et ses mécaniques tyroliennes lui donnent tout son style! Mais cela ne s'arrête pas là : son chevalet est à hauteur réglable, sa table est en épicéa et son fond en érable. ",
 215000, 4,13,'img_39.png', "2023-01-01 12:12:12", null,2, null),
 ('Contrebasse Glica Gama',"Fabriquée à la main en Europe : Reghin en Roumanie. Excellente contrebasse. Table en épicéa rigoureusement sélectionné. Dos et éclisses en érable ondé. Touche et cordier en ébène de bonne qualité. ",
 899900, 4,13,'img_40.png', "2023-01-01 12:12:12", null,1, null),
 ('Archer Etuis',"Etui recouvert d'une housse noire. Fermeture avec scratch au haut de l'étui. Bandoulière à l'épaule. Peut se ranger dans la poche archet d'une housse violoncelle Passion deluxe 4/4.",
 4500, 4,14,'img_41.png', "2023-01-01 12:12:12", null,15, null),
 ('Archer Bois du brésil',"Archer en bois du brésil. Entrée de gamme pour étudiants.",
 6900, 4,14,'img_42.png', "2023-01-01 12:12:12", null,9, null),
 ('Archer Carbone',"Découvrez notre archet en carbone, il est adapté aux violons de taille réduite 1/2. Vous serez charmés pour sa praticité et sa durabilité. Léger, il est aussi très souple et réactif, pour le plus grand plaisir des débutants et de leurs professeurs. ",
 11900, 4,14,'img_43.png', "2023-01-01 12:12:12", null,12, null),
 ('Platine Gemini',"Ce contrôleur DJ est autonome (pas besoin d'ordinateur pour l'utiliser) et lit les fichiers audio via usb, CD ou encore via Bluetooth de tout appareil (smartphone, ordinateur) avec metteur sans fil.",
 41900, 5,15,'img_44.png', "2023-01-01 12:12:12", null,5, null),
 ('Platine Stanton STX',"La marque Stanton est fière de vous présenter sa nouvelle platine vinyle, la STX. Cette platine ultra compacte a été spécialement pensée pour les amoureux du scratch qui souhaitent s’adonner à cette discipline en tout lieu, en particulier grâce à son haut-parleur intégré et à sa batterie embarquée.",
 35000, 5,15,'img_45.png', "2023-01-01 12:12:12", null,5, null),
 ('Platine Glorious VNL-500 USB',"La platine vinyle Glorious DJ VNL-500 USB est compatible pour des utilisations de type domestique, DJ et home studio. Elle est équipée d'un préamplificateur phono intégré et une sortie audio USB facilitant la numérisation de votre collection de vinyles.",
 34900, 5,15,'img_46.png', "2023-01-01 12:12:12", null,3, null),
 ('Cyclone analogic TT-78 Beat Bot',"La Cyclone Analogic TT-78 est une boîte à rythme analogique, offrant des sons de percussions: grosse caisse, caisse claire, conga, clave, cowbell, cymbal, charleston, maracas et tambourin.",
 49500, 5,16,'img_47.png', "2023-01-01 12:12:12", null,6, null),
 ('Moog DFAM',"La boite à rythme MOOG DFAM est un synthé percussif semi-modulaire analogique, première addition à l’écosystème Mother de Moog, pensé pour être utilisé par tous les amateurs de création rythmique, quel que soit leur niveau.",
 74900, 5,16,'img_48.png', "2023-01-01 12:12:12", null,4, null),
 ('Sequential Trigon-6',"Le Trigon-6 est l’interprétation par Sequential et dans une version polyphonique de ce son analogique classique, épais et crémeux obtenu par un filtre en échelle et 3 oscillateurs qui a marqué le début de l’ère des synthétiseurs. Un son qui transcende les modes et les styles – maintenant amélioré et repensé avec la touche unique de Sequential.",
 334900, 5,16,'img_49.png', "2023-01-01 12:12:12", null,3, null),
 ('Housse clavier X-Tone DJ',"Housse clavier 61 notes X-TONE 2100, épaisseur 10 mm.",
 4900, 5,17,'img_50.png', "2023-01-01 12:12:12", null,4, null),
 ('Casque Pioneer DJ',"Le HDJ-X10K de Pioneer est un casque de monitoring conçu pour les DJ professionnels, capable d'offrir un son parfait en toute circonstance, en studio ou en club. La bande-passante est parmi les plus larges du marché, puisque le casque descend à 5Hz et monte jusqu'à 40kHz! Les coussinets en simili-cuir sont ultra-résistants, tout en assurant un très bon confort d'écoute.",
 35900, 5,17,'img_51.png', "2023-01-01 12:12:12", null,19, null),
 ('Saxophone alto YAMAHA YAS 875E',"Le saxophone Custom YAS 875EX se caractérise par une réponse douce, une sonorité riche, pleine et profonde. La forme et la taille des nacres ont été redessinées pour un meilleur toucher",
 451000, 6,18,'img_52.png', "2023-01-01 12:12:12", null,1, null),
 ('Saxophone Trevor James Alpha',"Saxophone alto simplifié Trevor James, spécialement conçu pour les enfants.Fortement allégé, il permet aux enfants de débuter le saxophone très jeune et dans les meilleures conditions possibles.",
 84900, 6,18,'img_53.png', "2023-01-01 12:12:12", null,6, null),
 ('Saxophone ARNOLDS & SONS ASS-101C',"Les caractéristiques fondamentales des saxophones Arnolds & Sons sont une solide maîtrise, des matériaux parfaitement sélectionnés, ce qui implique une intonation et une réponse idéales. Par sa qualité et son petit prix, c'est le saxophone du débutant.",
 54900, 6,18,'img_54.png', "2023-01-01 12:12:12", null,8, null),
 ('Saxophone SELMER SERIE II JUBILEE',"125 ans auront permis à SELMER de créer l'alchimie acoustique et esthétique du saxophone et devenir ainsi le principal artisan de son évolution. A l'occasion de la célébration de son jubilé, la marque pose aujourd'hui les bases d'une nouvelle identité visuelle de l'instrument, tout en conservant intactes sa conception de son et la créativité de son ergonomie.",
 549000, 6,18,'img_55.png', "2023-01-01 12:12:12", null,1, null),
 ('Flûte traversière Yamaha YFL 282ID',"Livrée en étui et en housse, la flûte traversière YFL 282ID est une flûte d’étude qui n’a rien à envier aux modèles professionnels. Proposée dans le cadre de la Série 200, elle est conçue en maillechort et est sublimée par une finition argentée particulièrement élégante.",
 69900, 6,19,'img_56.png', "2023-01-01 12:12:12", null,5, null),
 ('Flûte traversière Trevor James Privilèges',"La Trevor James Privilège, avec sa plaque et son noyau en argent massif, mêle à elle seule esthétisme agréable et qualité sonore incroyable, avec un magnifique timbre, chaleureux et personnel.",
 91900, 6,19,'img_57.png', "2023-01-01 12:12:12", null,4, null),
 ('Flûte traversière Jupiter',"La flûte JFL 700R de la marque Jupiter est une flûte traversière d’étude. Conseillée par les professeurs et appréciée par les élèves de tous les niveaux, elle propose un confort de jeu auquel il sera difficile de rester indifférent.",
 51900, 6,19,'img_58.png', "2023-01-01 12:12:12", null,4, null),
 ('Flûte à bec alto YAMAHA YRA 314BIII',"Flûte à bec d'étude.",
 3900, 6,19,'img_59.png', "2023-01-01 12:12:12", null,24, null),
 ('Clarinette Buffet Crampon Prodige',"La clarinette Prodige de Buffet Crampon est proposée avec un clétage argenté. Réputée pour sa grande facilité de jeu et pour la qualité de sa conception et de ses matériaux, elle conviendra parfaitement aux musiciens qui veulent approfondir leur apprentissage.",
 43900, 6,19,'img_60.png', "2023-01-01 12:12:12", null,5, null),
 ('Clarinette Yamaha',"La clarinette Prodige de Buffet Crampon est proposée avec un clétage argenté. Réputée pour sa grande facilité de jeu et pour la qualité de sa conception et de ses matériaux, elle conviendra parfaitement aux musiciens qui veulent approfondir leur apprentissage.",
 109900, 6,19,'img_61.png', "2023-01-01 12:12:12", null,5,null),
 ('Trompette YAMAHA YTR 2330',"La trompette YTR 2330 est l'instrument idéal pour débuter : légère, facile à jouer, avec une très belle sonorité et une justesse parfaite, ce modèle rassemble toutes les qualités pour vous assurer un apprentissage dans les meilleures conditions.",
 49900, 6,20,'img_62.png', "2023-01-01 12:12:12", null,3, null),
 ('Trompette BACH TR-501',"Conçue selon les exigences qui font de Bach, une marque réputée, la trompette sib TR-501 saura séduire les musiciens en quête d’un instrument à la facture irréprochable.",
 69500, 6,20,'img_63.png', "2023-01-01 12:12:12", null,4, null),
 ('Cor YAMAHA YHR 567D',"Le célèbre 567D est un double cor au design semblable à celui du modèle novateur 667V. Bien qu'il coûte le prix d'un modèle intermédiaire, il est utilisé par les musiciens professionnels de célèbres orchestres. ",
 414500, 6,21,'img_64.png', "2023-01-01 12:12:12", null,2, null),
 ('Cor Hans Hoyer K10L1GA-L',"Le cor Hans Hoyer K10GA-L a été conçu selon le savoir-faire de la marque Hans Hoyer. Réputée pour la qualité de ses cuivres, elle a tout particulièrement soigné la qualité des finitions de ce cor double et l’a fabriqué à l’aide des meilleurs matériaux.",
 987600, 6,21,'img_65.png', "2023-01-01 12:12:12", null,1, null),
 ('Tuba Jupiter JTU 1110',"Mis en valeur par une finition vernie de grande qualité, il est doté d’un pavillon de 44 centimètres de diamètre, de quatre pistons et pèse une dizaine de kilos, des caractéristiques qui séduiront les tubistes les plus exigeants !",
 567000, 6,21,'img_66.png', "2023-01-01 12:12:12", null,2, null),
 ('Cymbales Zildjian K0965',"Une sublime cymbale ride 20 pouces, à la sonorité dark et aux harmoniques rondes et chaudes.",
 40900, 3,10,'img_67.png', "2023-01-01 12:12:12", null,11, null)
 ;

 /*-------------------comments tables----------*/

 CREATE TABLE comments(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    comment text,
    user_id int,
    product_id int,
    ratings float,
    created_at datetime
);

INSERT INTO comments (comment, user_id, product_id, ratings, created_at)
 VALUES
 ('Super heureux de cet achat !', 1, 1, 5, "2023-01-01 12:00:12"),
 ('Un peu chers mais le son est bon', 2, 3, 4, "2023-02-01 09:12:12"),
 ("On me l'avait conseillé mais je suis un peu déçu", 3, 1, 4, "2023-01-04 22:14:12");




 /*-------------------likes tables----------*/
 CREATE TABLE likes(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    product_id int,
    user_id int
 );

 /*-------------------tags tables----------*/
  CREATE TABLE tags(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(100)
 );

  INSERT INTO tags (name)
 VALUES
 ('bleu'),
 ('rouge'),
 ('noir'),
 ('blanc'),
 ('bois'),
 ('acajou'),
 ('gaucher'),
 ('débutant'),
 ('haut de gamme'),
 ('cèdre'),
 ('métal'),
 ('aluminium'),
 ('yamaha'),
 ('marshall'),
 ('woodbrass'),
 ('eagletone'),
 ('kawaï'),
 ('takamine'),
 ('mixage'),
 ('classique'),
 ('rock'),
 ('jazz')
 ;
 /*-------------------relation between tags and products table----------*/
   CREATE TABLE product_tag(
    product_id int,
    tag_id int
 );

 INSERT INTO product_tag (product_id, tag_id)
 VALUES
 (1,3),(1,9),(1,10),(1,20),(1,21),(1,13),
 (2,3),(2,9),(2,10),(2,20),(2,13),
 (3,3),(3,9),(3,10),(3,20),
 (4,3),(4,9),(4,10),(4,20),
 (5,3),(5,10),(5,10),(5,20),
 (6,3),(6,9),(6,20),(6,17),
 (7,3),(7,9),(4,20),(7,17),
 (8,3),(8,13),
 (9,3),(9,15),(9,7),
 (10,3),
 (11,3),(11,15),
 (12,3),(12,15),
 (13,5),(13,6),(13,10),(13,22),(13,8),
 (14,5),(14,6),(14,10),(14,22),(14,8),
 (15,5),(15,6),(15,10),(15,22),(15,8),(15,16),
 (16,21),(16,6),(16,10),(16,22),(16,8),
 (17,5),(17,6),(17,10),(17,22),(17,8),(17,16),
 (18,11),(18,8),(18,3),
 (19,11),(19,3),
 (20,11),(20,8),(20,3),
 (21,11),(21,3),
 (22,11),
 (23,11),(23,13),
 (24,21),(24,22),
 (25,22),
 (26,21),(26,22),
 (27,21),(27,22),(27,13),
 (28,21),(28,22),(28,13),
 (29,21),(29,22),(29,13),
 (32,5),(32,6),
 (33,5),(33,6),
 (35,5),(35,6),(35,20),
 (36,5),(36,6),(36,20),
 (37,5),(37,10),(37,20),
 (38,5),(38,6),(38,20),
 (39,5),(39,6),(39,20),
 (40,5),(40,10),(40,20),
 (44,19),
 (45,19),(45,8),
 (46,19),
 (47,19),(47,12),
 (48,19),
 (49,19),(49,12),
 (50,19),
 (51,19),(51,7),
 (52,22),(52,13),
 (53,22),
 (54,22),(54,8),
 (55,22),
 (56,20),(56,13),
 (57,20),(57,4),
 (58,20),(58,4),
 (59,20),(59,8),(59,13),
 (60,20),(60,8),(60,4),
 (61,20),(61,13),
 (62,13),(62,8),
 (63,8),
 (64,13),
 (65,9),
 (66,9),
 (67,21),(67,11);




 

 /*-------------------table orders----------*/

  CREATE TABLE orders(
    id int PRIMARY KEY NOT NULL,
    user_id int,
    created_at datetime,
    paid_at datetime,
    delivery varchar(15),
    tax_amount int,
    discount int,
    total_price int
 );


   CREATE TABLE orders_items(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    orders_id int,
    product_id int,
    quantity int,
    unit_price int
 );

  /*-------------------table cart----------*/

  CREATE TABLE cart(
   product_id int,
   unit_price int,
   quantity int,
   user_id int
  );

  CREATE TABLE cards(
   user_id int,
   card_no int,
   expiry_month int,
   expiry_year int,
   CVV int
  );