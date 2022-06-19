-- Adminer 4.8.1 PostgreSQL 14.2 (Debian 14.2-1.pgdg110+1) dump

DROP TABLE IF EXISTS "about";
DROP SEQUENCE IF EXISTS about_id_seq;
CREATE SEQUENCE about_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."about" (
    "id" integer DEFAULT nextval('about_id_seq') NOT NULL,
    "text" text,
    "small_text" text,
    "image" character varying(255) NOT NULL,
    CONSTRAINT "about_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "about" ("id", "text", "small_text", "image") VALUES
(1,	'<p>Мы - компания "Extremly" - <strong>мастодонты на рынке активного и нестандартного отдыха</strong>! На нашем счету более <strong>3000</strong> успешных поездок и туров в самые потрясающие и неверотные места нашей планенты! Почуствуй себя белым колонизатором Африки, поучаствуй в настоящем родео или же отправься на фестиваль Burning Man. Всё для вашего комфорта!</p>',	'<p><em>Для того, чтобы отправиться в путь - Вам нужно лишь приобрести билеты у нас на сайте, подготовить все необходимые вещи и документы, а также, иногда, пройти мед. осмотр.</em><em></em></p>',	'http://localhost:8000/uploads/164940076272923_1401882273.JPEG');

DROP TABLE IF EXISTS "advantage";
DROP SEQUENCE IF EXISTS advantage_id_seq;
CREATE SEQUENCE advantage_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."advantage" (
    "id" integer DEFAULT nextval('advantage_id_seq') NOT NULL,
    "title" character varying(64) NOT NULL,
    "text" text,
    CONSTRAINT "advantage_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "advantage" ("id", "title", "text") VALUES
(1,	'Мы сотрудничаем напрямую с организаторами!',	'Именно поэтому Вы можете быть уверены, что не переплатите деньги из за услуг посредников. Также Вы всегда будете знать, кто ответственен за организацию мероприятия. Просто расслабьтесь и положитесь на нас!'),
(2,	'Мы предлагаем только активный отдых!',	'Весь отпуск пролежать в отеле, смотря телевизор и опустошая минибар - это не про нас и наших клиентов! Мы предлагаем только активный и необычных отдых, так что можете быть уверены - скучно вам точно не будет!'),
(3,	'Мы подготовим всё для вашего отдыха!',	'Команда Extremly берёт все организационные вопросы и моменты на себя. Всё что от Вас требуется - приобрести билеты, подготовить документы и вещи и прибыть на пункт сбора во время! Так что будьте спокойны - мы всё сделаем за Вас!');

DROP TABLE IF EXISTS "application";
DROP SEQUENCE IF EXISTS application_id_seq;
CREATE SEQUENCE application_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."application" (
    "id" integer DEFAULT nextval('application_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "num" integer NOT NULL,
    "status_id" integer DEFAULT '1' NOT NULL,
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "application_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-application-status_id" ON "public"."application" USING btree ("status_id");

CREATE INDEX "idx-application-user_id" ON "public"."application" USING btree ("user_id");

INSERT INTO "application" ("id", "user_id", "num", "status_id", "created_at") VALUES
(1,	1,	1,	3,	'2022-04-08 08:46:06'),
(2,	1,	3,	1,	'2022-04-08 19:07:26'),
(3,	1,	1,	1,	'2022-04-09 05:39:37'),
(4,	1,	2,	1,	'2022-04-10 09:57:14'),
(5,	1,	1,	1,	'2022-04-10 09:58:15'),
(6,	1,	1,	1,	'2022-04-10 09:58:38'),
(38,	1,	4,	1,	'2022-04-12 12:18:36');

DROP TABLE IF EXISTS "banned";
DROP SEQUENCE IF EXISTS banned_id_seq;
CREATE SEQUENCE banned_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."banned" (
    "id" integer DEFAULT nextval('banned_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "reason" character varying(128),
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "banned_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "banned_user_id_key" UNIQUE ("user_id")
) WITH (oids = false);

CREATE INDEX "idx-banned_user_id" ON "public"."banned" USING btree ("user_id");

INSERT INTO "banned" ("id", "user_id", "reason", "created_at") VALUES
(1,	3,	NULL,	'2022-04-12 12:23:34');

DROP TABLE IF EXISTS "climat";
CREATE TABLE "public"."climat" (
    "code" character varying(8) NOT NULL,
    "name" character varying(64) NOT NULL,
    "icon" character varying(256) NOT NULL,
    CONSTRAINT "climat_code_key" UNIQUE ("code"),
    CONSTRAINT "climat_name_key" UNIQUE ("name"),
    CONSTRAINT "pk-climat-code" PRIMARY KEY ("code")
) WITH (oids = false);

INSERT INTO "climat" ("code", "name", "icon") VALUES
('HOT',	'Засушливый',	'http://localhost:8000/uploads/1649401951free-icon-sun-1163662.png'),
('CLOUD',	'Пасмурный',	'http://localhost:8000/uploads/1649401978free-icon-cloudy-1163661.png'),
('RAIN',	'Дожливый',	'http://localhost:8000/uploads/1649402040free-icon-weather-app-3767039.png'),
('SNOW',	'Снежный',	'http://localhost:8000/uploads/1649402166free-icon-snow-cloud-6319800.png');

DROP TABLE IF EXISTS "country";
CREATE TABLE "public"."country" (
    "code" character varying(2) NOT NULL,
    "name" character varying(64) NOT NULL,
    "flag" character varying(256) NOT NULL,
    CONSTRAINT "country_code_key" UNIQUE ("code"),
    CONSTRAINT "country_name_key" UNIQUE ("name"),
    CONSTRAINT "pk-country-code" PRIMARY KEY ("code")
) WITH (oids = false);

INSERT INTO "country" ("code", "name", "flag") VALUES
('RU',	'Россия',	'http://localhost:8000/uploads/1649401469russia.gif'),
('US',	'США',	'http://localhost:8000/uploads/1649401496usa.gif'),
('EG',	'Египет',	'http://localhost:8000/uploads/1649401588egypt.gif'),
('ES',	'Испания',	'http://localhost:8000/uploads/1649401685ispaniya.gif'),
('JP',	'Япония',	'http://localhost:8000/uploads/1649401767yapan.gif'),
('IN',	'Индия',	'http://localhost:8000/uploads/1649401895indiya.gif');

DROP TABLE IF EXISTS "event";
DROP SEQUENCE IF EXISTS event_id_seq;
CREATE SEQUENCE event_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."event" (
    "id" integer DEFAULT nextval('event_id_seq') NOT NULL,
    "name" character varying(256) NOT NULL,
    "offer" text,
    "from" timestamp(0),
    "until" timestamp(0),
    "description" text,
    "age_restrictions" integer DEFAULT '12' NOT NULL,
    "priority" integer DEFAULT '1' NOT NULL,
    "is_horizontal" boolean DEFAULT true NOT NULL,
    "place_id" integer NOT NULL,
    "type_id" integer NOT NULL,
    "ticket_num" integer DEFAULT '10' NOT NULL,
    CONSTRAINT "event_name_key" UNIQUE ("name"),
    CONSTRAINT "event_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-event-place_id" ON "public"."event" USING btree ("place_id");

CREATE INDEX "idx-event-type_id" ON "public"."event" USING btree ("type_id");

INSERT INTO "event" ("id", "name", "offer", "from", "until", "description", "age_restrictions", "priority", "is_horizontal", "place_id", "type_id", "ticket_num") VALUES
(2,	'День вулкана',	'<p>Приглашаем вас осуществить грандиозное восхождение на самую вершину Авачинской сопки! Весёлая компания, активный отдых и замечательные впечатления.</p>',	NULL,	NULL,	'<p><strong>Камчатка</strong> издавна является землей легенд. Коренные жители зачастую устраивали праздники под стать природе, боготворили её, приносили ей дары и воспевали в песнях. Не остались и без внимания самые гордые постояльцы Камчатской земли — <a href="https://kamchatkaland.ru/note/vulkany-kamchatki">вулканы</a>.</p><p> Ежегодным и самым молодым местным праздником стал <strong>«День Вулкана» на Камчатке.</strong> Праздник, который проводится в рамках дней туризма в Камчатском крае. Основной территорией проведения фестиваля служит Налычевская долина. Отмечают этот день в летний период. В последние года фестиваль расширяется как в плане территорий, так и в плане времени празднования. Несколько лет, праздник отмечался не одним днём и начинался уже в июне.</p><p> <strong>Камчатка</strong> издавна является землей легенд. Коренные жители зачастую устраивали праздники под стать природе, боготворили её, приносили ей дары и воспевали в песнях. Не остались и без внимания самые гордые постояльцы Камчатской земли — <a href="https://kamchatkaland.ru/note/vulkany-kamchatki">вулканы</a>.</p><p> Ежегодным и самым молодым местным праздником стал «<strong>День Вулкана» на Камчатке</strong>. Праздник, который проводится в рамках дней туризма в Камчатском крае. Основной территорией проведения фестиваля служит Налычевская долина. Отмечают этот день в летний период. В последние года фестиваль расширяется как в плане территорий, так и в плане времени празднования. Несколько лет, праздник отмечался не одним днём и начинался уже в июне.</p><p>Также в программе праздника выход к району горы Верблюд, множество конкурсов, просмотры фильмов, выступления творческих коллективов, мото-соревнования, йога, пикник, танцы и даже гольф. Гольф под вулканами — это мероприятие, не имеющее аналогов во всем мире. Задача краевой федерации гольфа в Камчатском крае состоит в адаптации площадок вулканического рельефа к игре, а также обучении подрастающего поколения.<br></p>',	12,	1,	'0',	3,	1,	10),
(1,	'Неделя ужасов в Отеле "Оверлук"',	'<p>Хотите пощекокать себе нервы? Предлагаем провести вам неделю в отеле Оверлук (<a href="http://localhost:8000/admin/place/view?id=1">Отель Timberline Lodge</a>), Днём - это обычный отель, но ночью здесь монстыр и чудища сходят со страницы культовой книги Стивена Кинга "Сияние"</p>',	NULL,	NULL,	'<blockquote><b>Оверлук</b> был уединенным отелем, расположенным в Скалистых горах. В течение всей истории отеля он был местом многих сомнительных действий, включая самоубийства, бандитские разборки и многие подозрительные изменения владельца. Тем не менее, Оверлук остается роскошным местом, известным своими роскошными территориями и захватывающим видом на горы</blockquote><p>В романе <i>Сияние</i> показано, что <strong>Оверлук</strong> был построен между 1907 и 1909 годами человеком по имени Роберт Таунли Уотсон, дедушкой нынешнего технического работника, Пита Уотсона. Джек Торранс, его жена Венди Торранс и сын Дэнни Торранс прибывают в отель "Оверлук" как раз в тот момент, когда все выезжают. Им устроил грандиозную экскурсию Мистер Уллман. Шеф-повар отеля Холлоран говорит Дэнни, что отель Оверлук имеет темную историю и предупреждает его держаться подальше от номера 217. Торрансы наблюдают, как все покидают отель, пока последний человек не уходит, и они остаются одни в отеле. Во-первых, отель кажется благословением для них, и Венди утверждает, что это самое счастливое место, где она когда-либо была. Но Дэнни скрывает темные секреты, и вскоре начинает видеть ужасающие видения и призраков. Однажды Дэнни входит в комнату 217 и обнаруживает в ванне труп, который улыбается ему и пытается задушить его. Его находит Венди, которая обвиняет Джека. Однако Дэнни говорит Венди, что это была Мисс Мэсси, и Джек входит в комнату. Он ничего не находит, но слышит приближающиеся шаги Мисс Мэсси. Джек в испуге убегает из комнаты, и больше в комнату никто не входит. Дэнни начинает видеть более страшные видения, и топиарные животные оживают. Джек медленно начинает сходить с ума, и призрак предыдущего смотрителя убедил его убить свою жену и сына, чтобы отель мог унаследовать силу Дэнни. Дэнни зовет Холлоранна на помощь с его сиянием, и он приходит. Отель умудряется убить Джека, а Венди, Дэнни и Холлоранн убегают из отеля как раз в тот момент, когда котел взрывается, разрушая отель.</p><p>Мы предлагаем вам провести неделю в этом культовом месте! Для гостей будет орагнизована специальная программа про усстрашению и наведению ужаса!<br></p>',	18,	1,	'0',	1,	3,	100),
(3,	'Burning Man',	'<p>Самый неординарный фестиваль в мире! Проведите время среди молодых и интересных людей с уникальным взглядом на мир. Пустыня Блэк-Рок - очень уютное место.<br></p>',	NULL,	NULL,	'<p>«Burning Man» (рус. «Горящий Человек») — ежегодное событие, проходящее в пустыне Блэк-Рок в Неваде. Событие начинается в последний понедельник августа в 00:01 и длится восемь дней. Последний день приходится на День Труда, официальный праздник, отмечаемый в США в первый понедельник сентября, выходной день для большинства организаций. Кульминация происходит в субботу после заката, когда сжигают огромную деревянную статую человека.</p><p><br><br>Сами организаторы определяют событие как эксперимент, но не фестиваль, по созданию сообщества радикального самовыражения, при этом полностью полагающегося только на себя (англ. radical self-expression, and radical self-reliance). На неделю в пустыне устанавливаются произведения современного искусства, часто фантастических форм. Некоторые из них сжигаются создателями до окончания «Burning Man». Там ездят сотни «мутированных» машин (англ. mutant vehicles) самого невероятного вида, многие участники ходят в костюмах персонажей из произведений искусства и культуры, зверей, предметов и так далее. Приехавшие в пустыню артисты дают выступления, популярны различные танцы. На нескольких танцполах круглосуточно работают диджеи. Вместе с тем, каждый участник ответственен за своё жизнеобеспечение (питание, воду, защиту от жары, ветра, холода, место для ночлега и так далее) и очистку пустыни от каких-либо следов своего пребывания; обо всём этом надо позаботиться заранее.</p><p><br><br>Первое сожжение небольшого деревянного человека произошло в 1986 году, тогда ещё на одном из пляжей Сан-Франциско, небольшой группой друзей. Впоследствии круг участников расширился и переместился на нынешнее место в пустыню в штате Невада.</p>',	18,	1,	'0',	2,	2,	10),
(4,	'Энсьерро',	'<p>Вам не хватает острых ощущений? Чтож, тогда у нас есть <strong>приятный сюрприз</strong> для Вас! Поучаствуйте в испанском нациальном празднике, суть котого заключается в <strong>убегании от быков!</strong></p>',	NULL,	NULL,	'<p>Энсьерро (исп. encierro, от encerrar — запирать) — испанский национальный обычай, состоящий в убегании от специально выпущенных из загона быков, коров или телят. Прогон быков или коров и убегание от них вообще до сих пор является распространённым развлечением в сельской местности Испании. В ряде посёлков (например, в Сегорбе, (провинция Кастельон)) прогон быков всадниками является частью местных праздников. Слово «энсьерро», однако, применимо только к прогону быков в городских условиях, обычно из загона к арене для боя быков (поэтому энсьерро может рассматриваться как своеобразный пролог корриды). </p><p>Весь маршрут пробега (от загона до арены по городским улицам) огораживается деревянными барьерами из брусьев, на которые достаточно легко залезть (или подлезть под них). Длина маршрута — около 1 км. Бегунами могут быть все желающие — в первую очередь это члены местных клубов любителей корриды (которых можно узнать по своеобразной униформе) и иностранные <a href="https://ru.wikipedia.org/wiki/%D0%A2%D1%83%D1%80%D0%B8%D1%81%D1%82" class="mw-redirect" title="Турист">туристы</a> (в 2014 году 56% участников Сан-Фермина были иностранцами, в некоторые годы этот показатель достигал 70%; больше всех на праздник съезжается граждан США — 24% от общего числа, австралийцев и новозеландцев — 11%, британцев — 4%. Как правило, эти люди мало представляют, с чем им придется столкнуться на энсьеррос — именно новички, по статистике, в большинстве являются пострадавшими в забеге с быками). Организаторы стремятся не допускать на забег людей, находящихся под воздействием алкоголя или наркотиков, но это удаётся не всегда. Именно пьяные туристы чаще всего получают травмы в ходе энсьерро.<br></p>',	18,	2,	'0',	4,	2,	120);

DROP TABLE IF EXISTS "event_image";
DROP SEQUENCE IF EXISTS event_image_id_seq;
CREATE SEQUENCE event_image_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."event_image" (
    "id" integer DEFAULT nextval('event_image_id_seq') NOT NULL,
    "event_id" integer NOT NULL,
    "image" character varying(256) NOT NULL,
    CONSTRAINT "event_image_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-event_image-event_id" ON "public"."event_image" USING btree ("event_id");

INSERT INTO "event_image" ("id", "event_id", "image") VALUES
(1,	1,	'http://localhost:8000/uploads/1649404830girls.jpg'),
(2,	1,	'http://localhost:8000/uploads/1649404830maxresdefault.jpg'),
(3,	1,	'http://localhost:8000/uploads/1649404830shining.jpg'),
(4,	2,	'http://localhost:8000/uploads/1649405688vulkan.jpg'),
(5,	2,	'http://localhost:8000/uploads/1649405688vulkan2.jpg'),
(6,	2,	'http://localhost:8000/uploads/1649405688мгдлфт.jpg'),
(7,	3,	'http://localhost:8000/uploads/1649405953bur.jpg'),
(8,	3,	'http://localhost:8000/uploads/1649405953bur2.jpeg'),
(9,	3,	'http://localhost:8000/uploads/1649405953bur3.jpg'),
(10,	4,	'http://localhost:8000/uploads/1649441262ens.jpg'),
(11,	4,	'http://localhost:8000/uploads/1649441262ens2.jpg'),
(12,	4,	'http://localhost:8000/uploads/1649441262ens3.jpeg');

DROP TABLE IF EXISTS "event_person";
CREATE TABLE "public"."event_person" (
    "event_id" integer NOT NULL,
    "person_id" integer NOT NULL,
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "pk-event_person" PRIMARY KEY ("event_id", "person_id")
) WITH (oids = false);

CREATE INDEX "idx-event_person-event_id" ON "public"."event_person" USING btree ("event_id");

CREATE INDEX "idx-event_person-person_id" ON "public"."event_person" USING btree ("person_id");

INSERT INTO "event_person" ("event_id", "person_id", "created_at") VALUES
(2,	1,	'2022-04-08 17:17:39'),
(2,	2,	'2022-04-08 17:17:39'),
(1,	1,	'2022-04-08 17:18:02'),
(1,	2,	'2022-04-08 17:18:02'),
(1,	3,	'2022-04-08 17:18:02'),
(3,	2,	'2022-04-08 18:44:08'),
(3,	3,	'2022-04-08 18:44:08'),
(3,	4,	'2022-04-08 18:44:08'),
(4,	1,	'2022-04-08 18:44:26'),
(4,	2,	'2022-04-08 18:44:26'),
(4,	4,	'2022-04-08 18:44:26'),
(3,	1,	'2022-04-09 05:42:37');

DROP TABLE IF EXISTS "event_review";
DROP SEQUENCE IF EXISTS event_review_id_seq;
CREATE SEQUENCE event_review_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."event_review" (
    "id" integer DEFAULT nextval('event_review_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "event_id" integer NOT NULL,
    "text" text NOT NULL,
    "rating" integer NOT NULL,
    "is_visible" boolean DEFAULT true,
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "event_review_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-event_review-event_id" ON "public"."event_review" USING btree ("event_id");

CREATE INDEX "idx-event_review-user_id" ON "public"."event_review" USING btree ("user_id");

INSERT INTO "event_review" ("id", "user_id", "event_id", "text", "rating", "is_visible", "created_at") VALUES
(1,	1,	1,	'Всем советую - очень круто',	5,	'1',	'2022-04-08 08:47:22'),
(2,	1,	3,	'Обожаю это',	5,	'1',	'2022-04-08 08:47:36'),
(3,	1,	1,	'Попробуйте, пожалуйста..',	5,	'1',	'2022-04-08 17:26:18'),
(4,	2,	4,	'Обожаю это меррприятие!',	5,	'1',	'2022-04-08 18:45:54'),
(5,	2,	3,	'Обязательно поеду',	5,	'1',	'2022-04-08 18:46:08'),
(6,	1,	2,	'dhskfjhagk',	5,	'1',	'2022-04-09 05:01:39'),
(7,	1,	2,	'дролоролршр',	5,	'1',	'2022-04-09 05:39:17'),
(8,	2,	2,	'Я вонючка',	5,	'1',	'2022-04-09 07:49:27'),
(9,	2,	2,	'вафыавыф',	5,	'1',	'2022-04-09 07:49:34');

DROP TABLE IF EXISTS "event_type";
DROP SEQUENCE IF EXISTS event_type_id_seq;
CREATE SEQUENCE event_type_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."event_type" (
    "id" integer DEFAULT nextval('event_type_id_seq') NOT NULL,
    "name" character varying(64) NOT NULL,
    "icon" character varying(256) NOT NULL,
    CONSTRAINT "event_type_name_key" UNIQUE ("name"),
    CONSTRAINT "event_type_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "event_type" ("id", "name", "icon") VALUES
(1,	'Турпоход',	'http://localhost:8000/uploads/1649404004turpohod.png'),
(2,	'Фестиваль',	'http://localhost:8000/uploads/1649404043—Pngtree—flat holi festival colorful splash_4005134.png'),
(3,	'Тематическая встреча',	'http://localhost:8000/uploads/1649404197—Pngtree—the internet meeting discussion discuss_3799543.png');

DROP TABLE IF EXISTS "migration";
CREATE TABLE "public"."migration" (
    "version" character varying(180) NOT NULL,
    "apply_time" integer,
    CONSTRAINT "migration_pkey" PRIMARY KEY ("version")
) WITH (oids = false);

INSERT INTO "migration" ("version", "apply_time") VALUES
('m000000_000000_base',	1648652397),
('m220308_122536_create_country_table',	1649398238),
('m220308_124339_create_climat_table',	1649398238),
('m220308_130353_create_event_type_table',	1649398238),
('m220308_130604_create_role_table',	1649398238),
('m220308_130711_create_place_table',	1649398238),
('m220308_130743_create_place_image_table',	1649398238),
('m220308_130950_create_event_table',	1649398238),
('m220308_131035_create_event_image_table',	1649398238),
('m220308_131203_create_ticket_table',	1649398239),
('m220308_131235_create_person_table',	1649398239),
('m220308_131300_create_person_image_table',	1649398239),
('m220308_131432_create_user_table',	1649398239),
('m220308_131523_create_status_table',	1649398239),
('m220308_131524_create_application_table',	1649398239),
('m220308_165848_create_junction_table_for_event_and_person',	1649398239),
('m220308_170806_create_junction_table_for_user_and_event_table',	1649398239),
('m220312_105816_create_review_table',	1649398239),
('m220312_105838_create_event_review_table',	1649398239),
('m220329_162416_create_banned_table',	1649398239),
('m220406_063006_create_static_content_table',	1649398239),
('m220406_065605_create_advantage_table',	1649398239),
('m220406_070242_create_about_table',	1649398239),
('m220406_070703_create_person_link_table',	1649398239),
('m220406_070736_create_social_link_table',	1649398239),
('m220407_092516_create_junction_table_for_ticket_and_application_table',	1649398239);

DROP TABLE IF EXISTS "person";
DROP SEQUENCE IF EXISTS person_id_seq;
CREATE SEQUENCE person_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."person" (
    "id" integer DEFAULT nextval('person_id_seq') NOT NULL,
    "firstname" character varying(64) NOT NULL,
    "lastname" character varying(64) NOT NULL,
    "patronymic" character varying(64),
    "age" integer NOT NULL,
    "description" text,
    "role" text DEFAULT 'Организатор',
    CONSTRAINT "person_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "person" ("id", "firstname", "lastname", "patronymic", "age", "description", "role") VALUES
(1,	'Антон',	'Арканов',	'Валеронович',	32,	'<p>Антон - эксперт по Американской культуре. Именно он ответсеннен за органзиацию таких мерроприятий, как поездка в отель "Оверлук" и поездка на фестиваль "Burning Man"! Обладая высококлассными навыками организации и менджемента, Антон активно проявялет лидерские качества. А ещё он обожает фастфуд поэтому дерижте своим бургеры подальше от него!</p>',	'Организатор'),
(2,	'Елена',	'Ивашкова',	'Артуровна',	26,	'<p>Елена - самый опытный туррист из всех наших приглашённых гостей! Она не раз взбиралась на самые выские вершины, ночевала в густом лесу и проходила оргомные расстояние пешком. Вместе с ней Вы точно будете в безопасности и в кофморте! А ещё она няшка =)</p>',	'Гид'),
(3,	'Алина',	'Фатахова',	'Игорьевна',	29,	'<p>Алина - очень разносторонний и эридуированный сотрудник! Сложно найти тему, в которой она бы не могла плавать, как рыба в воде. Именно поэтому Алина отвечает за тематические встречи. Она  обожает поп-культуру! И ещё любит лазанью.</p>',	'Организатор'),
(4,	'Виктор',	'Паровозов',	'Евгеньевич',	45,	'<p>Фанат активного отдха со стжаем. Виктор знает все самые лучше места и курорты на планете. Именно за это мы его ценим. А ещё потому что у него есть машина и он довозит нас домой!<br></p>',	'Сопроводитель');

DROP TABLE IF EXISTS "person_image";
DROP SEQUENCE IF EXISTS person_image_id_seq;
CREATE SEQUENCE person_image_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."person_image" (
    "id" integer DEFAULT nextval('person_image_id_seq') NOT NULL,
    "person_id" integer NOT NULL,
    "image" character varying(256) NOT NULL,
    CONSTRAINT "person_image_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-person_image-person_id" ON "public"."person_image" USING btree ("person_id");

INSERT INTO "person_image" ("id", "person_id", "image") VALUES
(1,	1,	'http://localhost:8000/uploads/16494062744e42e27466ba89efdfd7b3ee8bc0b551.jpg'),
(2,	2,	'http://localhost:8000/uploads/1649406562elena.jpg'),
(3,	3,	'http://localhost:8000/uploads/1649406747alina.jpg'),
(4,	4,	'http://localhost:8000/uploads/1649443418Nitsevich-V.F..jpg');

DROP TABLE IF EXISTS "person_link";
DROP SEQUENCE IF EXISTS person_link_id_seq;
CREATE SEQUENCE person_link_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."person_link" (
    "id" integer DEFAULT nextval('person_link_id_seq') NOT NULL,
    "person_id" integer NOT NULL,
    "title" character varying(255) NOT NULL,
    "icon" character varying(255) NOT NULL,
    "url" character varying(255) NOT NULL,
    CONSTRAINT "person_link_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-person_link-person_id" ON "public"."person_link" USING btree ("person_id");

INSERT INTO "person_link" ("id", "person_id", "title", "icon", "url") VALUES
(1,	1,	'Youtube',	'http://localhost:8000/uploads/1649406321ytb.png',	'https://www.youtube.com/'),
(2,	1,	'WhatsUp',	'http://localhost:8000/uploads/1649406355wtsuo.png',	'https://www.whatsapp.com/?lang=ru'),
(3,	2,	'WhatsUp',	'http://localhost:8000/uploads/1649406614wtsuo.png',	'https://www.whatsapp.com/?lang=ru');

DROP TABLE IF EXISTS "place";
DROP SEQUENCE IF EXISTS place_id_seq;
CREATE SEQUENCE place_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."place" (
    "id" integer DEFAULT nextval('place_id_seq') NOT NULL,
    "name" character varying(256) NOT NULL,
    "address" character varying(256) NOT NULL,
    "description" text NOT NULL,
    "climat_code" character varying(8) NOT NULL,
    "country_code" character varying(2) NOT NULL,
    "map" character varying(255),
    CONSTRAINT "place_address_key" UNIQUE ("address"),
    CONSTRAINT "place_name_key" UNIQUE ("name"),
    CONSTRAINT "place_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-place-climat_code" ON "public"."place" USING btree ("climat_code");

CREATE INDEX "idx-place-country_code" ON "public"."place" USING btree ("country_code");

INSERT INTO "place" ("id", "name", "address", "description", "climat_code", "country_code", "map") VALUES
(1,	'Отель Timberline Lodge',	'27500 E Timberline Road, Government Camp, OR 97028, Соединенные Штаты',	'<p><strong>Отель Timberline Lodge </strong>расположен в глубине национального парка Маунт-Худ в районе Тимберлайн, штат Орегон. Лыжные трассы проходят прямо у порога. К услугам гостей сауна, открытый бассейн с подогревом, 3 ресторана и бесплатный WiFi.</p><p>Именно здесь снималья культовый фильм <a href="https://ru.wikipedia.org/wiki/%D0%9A%D1%83%D0%B1%D1%80%D0%B8%D0%BA,_%D0%A1%D1%82%D1%8D%D0%BD%D0%BB%D0%B8" target="_blank">Стенли Кубрика</a> <a href="https://ru.wikipedia.org/wiki/%D0%A1%D0%B8%D1%8F%D0%BD%D0%B8%D0%B5_(%D1%84%D0%B8%D0%BB%D1%8C%D0%BC)" target="_blank">Сияние</a>!<br></p><p>Номера оформлены в загородном стиле и обставлены мебелью ручной работы. В числе удобств телевизор с кабельными или спутниковыми каналами и гладильные принадлежности. Собственные ванные комнаты с ванной или душем укомплектованы бесплатными туалетно-косметическими принадлежностями.</p><p><br></p><p>На территории отеля работает несколько заведений общественного питания. В баре <strong>Blue Ox</strong> подают блюда по меню паба, бар <strong>Ram’s Head</strong> специализируется на блюдах повседневной кухни, а в ресторане Cascade Dining Room гостям предложат блюда изысканной кухни. После ужина гости могут заказать напитки в баре или отдохнуть в сауне и гидромассажной ванне.</p><p><br></p><p>В числе удобств услуги консьержа, экскурсионное бюро, фитнес-центр, бизнес-центр и магазины на территории комплекса. В отеле работает пункт проката лыжного снаряжения. Новички могут освоить азы мастерства в лыжной школе.</p><p><br></p><p>Отель Timberline Lodge находится в 11 км от парка аттракционов <strong>Маунт-Худ Скибоул</strong>, в 30 км от поля для гольфа The Courses и в 119 км от национального заповедника дикой природы Пирс. </p>',	'SNOW',	'US',	'constructor%3Ae59245182ae5f0ca422b86ddee4e0694ddabf55dc117ef21d4736d55d872c6c1'),
(2,	'Блэк-Рок (пустыня)',	'40°52′59″ с. ш. 119°03′50″ з. д.',	'<p>Блэк-Рок (англ. Black Rock Desert) — пустыня на северо-западе штата Невада в США. Площадь пустыни составляет 2,6 тыс. км² при длине 110 км и ширине 32 км. Часть бессточного Большого Бассейна. Знаменита проведением фестиваля Burning man.</p><p><br>Пустыня является частью высохшего доисторического озера Лаонтан, которое существовало 18-7 тыс. лет до н. э. во время последнего ледникового периода. При максимальном заполнении озера около 12,7 тыс. лет назад, пустыня находилась на глубине 150 м. В настоящее время является регионом стока реки Куинн (англ. Quinn River), воды которой иногда покрывают пустыню слоем в несколько сантиметров.</p><p><br>К юго-западу от пустыни Блэк-Рок и к северу от озера Пирамид лежит пустыня Смок-Крик Пустыня Блэк-Рок является местным центром добычи гипса. Сухая поверхность дна озера в южной части служила полигоном для установки нескольких рекордов скорости на автомобиле.</p><p><br>С 1986 года в пустыне проводится ежегодный фестиваль Burning Man, который привлекает несколько десятков тысяч людей в безлюдные районы пустыни.</p>',	'HOT',	'US',	'constructor%3Ae81140f0215a6e2936b7170302819d3c0d129683a74fa6a8cdc0cbccc90a0941'),
(3,	'Авачинская Сопка',	'53°15′20″ с. ш. 158°50′00″ в. д.',	'<p>Ава́чинская Со́пка, Ава́чинская со́пка (Ава́ча), Авачинский, Авач-гора, Горелая сопка — действующий вулкан на Камчатке, в южной части Восточного хребта, к северу от Петропавловска-Камчатского, в междуречье рек Авачи и Налычева. Относится к вулканам типа Сомма-Везувий. <br>Высота 2741 м (по другим данным 2717 м), вершина конусообразная. Конус сложен базальтовыми и андезитовыми лавами, туфами и шлаком. Диаметр кратера — 400 м, имеются многочисленные фумаролы. В результате извержения, произошедшего в 1991 году, в кратере вулкана образовалась массивная лавовая пробка. В вершинной части вулкана (вместе с вулканом Козельский) расположено десять ледников на площади 10,2 км².</p><p><br>Нижние склоны вулкана покрыты лесами из кедрового стланика и каменной берёзы, в верхней части — ледники и снег. Ледник на северном склоне назван в честь дальневосточного исследователя В. К. Арсеньева.</p><p><br>У подножья вулкана расположена вулканологическая станция Института вулканологии Дальневосточного отделения РАН.</p><p><br>Первые исследование и описание вулкана выполнено С. П. Крашенинниковым в 1730-х годах.</p>',	'SNOW',	'RU',	'constructor%3Aa85f55b6a66131378edd7012335c712b22b757b3d9f76970b954b306570d4a16'),
(4,	'Памплона',	'42°49′ с. ш. 1°39′ з. д.',	'<p><strong>Пампло́на (Ирунья)</strong> (исп. Pamplona, баск. Iruña, лат. Pompaelo, Pompelon, Pompeiopolis, Pampilona) — столица автономной области Наварра на севере Испании, один из древнейших городов страны. Расположена у подножия Западных Пиренеев, на реке Арге (притоке Арагона). Муниципалитет находится в составе района (комарки) Куэнка-де-Памплона.</p><p> Наибольшую известность в мире Памплона получила благодаря празднику Сан-Фермин, проходящему ежегодно с 6 по 14 июля (увековечен в романе Эрнеста Хемингуэя «<strong>И восходит солнце (Фиеста)»</strong>) и, прежде всего, благодаря энсьерро — бегу по улицам города мужчин от двенадцати разъярённых быков. </p>',	'HOT',	'ES',	'constructor%3Add405d639f6234a38e90ba1415424ab09d1ecaae5f265ea28f1bd83d25326420');

DROP TABLE IF EXISTS "place_image";
DROP SEQUENCE IF EXISTS place_image_id_seq;
CREATE SEQUENCE place_image_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."place_image" (
    "id" integer DEFAULT nextval('place_image_id_seq') NOT NULL,
    "place_id" integer NOT NULL,
    "image" character varying(256) NOT NULL,
    CONSTRAINT "place_image_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-place_image-place_id" ON "public"."place_image" USING btree ("place_id");

INSERT INTO "place_image" ("id", "place_id", "image") VALUES
(1,	1,	'http://localhost:8000/uploads/1649402804overlook1.jpg'),
(2,	1,	'http://localhost:8000/uploads/1649402804overlook2.jpg'),
(3,	1,	'http://localhost:8000/uploads/1649402804overlook3.jpg'),
(4,	2,	'http://localhost:8000/uploads/1649403480black-rock.jpg'),
(5,	2,	'http://localhost:8000/uploads/1649403480black-rock2.jpg'),
(6,	2,	'http://localhost:8000/uploads/1649403480black_rock_19982489851.jpg'),
(7,	3,	'http://localhost:8000/uploads/1649403912avach.jpg'),
(8,	3,	'http://localhost:8000/uploads/1649403912avach2.jpg'),
(9,	4,	'http://localhost:8000/uploads/1649440932pamp.jpg'),
(10,	4,	'http://localhost:8000/uploads/1649440932pamp2.jpg'),
(11,	4,	'http://localhost:8000/uploads/1649440932pamp3.jpg');

DROP TABLE IF EXISTS "review";
DROP SEQUENCE IF EXISTS review_id_seq;
CREATE SEQUENCE review_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."review" (
    "id" integer DEFAULT nextval('review_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "text" text NOT NULL,
    "rating" integer NOT NULL,
    "is_visible" boolean DEFAULT true,
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "review_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-review-user_id" ON "public"."review" USING btree ("user_id");

INSERT INTO "review" ("id", "user_id", "text", "rating", "is_visible", "created_at") VALUES
(1,	1,	'Отличный проект - люди замечательные и всё такое)',	5,	'1',	'2022-04-08 08:40:19'),
(2,	1,	'Хороший тамада и конкурсы интересные',	5,	'1',	'2022-04-08 08:40:38'),
(23,	2,	'Мне всё нравится =)',	5,	'1',	'2022-04-08 18:13:51'),
(24,	1,	'rrdtdtdtrd',	5,	'1',	'2022-04-09 05:02:48'),
(25,	2,	'аффаовлдаволфдваофлдлф',	5,	'1',	'2022-04-09 07:50:28');

DROP TABLE IF EXISTS "role";
DROP SEQUENCE IF EXISTS role_id_seq;
CREATE SEQUENCE role_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."role" (
    "id" integer DEFAULT nextval('role_id_seq') NOT NULL,
    "name" character varying(32) NOT NULL,
    CONSTRAINT "role_name_key" UNIQUE ("name"),
    CONSTRAINT "role_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "role" ("id", "name") VALUES
(1,	'админ'),
(2,	'модератор'),
(3,	'пользователь');

DROP TABLE IF EXISTS "social_link";
DROP SEQUENCE IF EXISTS social_link_id_seq;
CREATE SEQUENCE social_link_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."social_link" (
    "id" integer DEFAULT nextval('social_link_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "icon" character varying(255) NOT NULL,
    "url" character varying(255) NOT NULL,
    CONSTRAINT "social_link_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "social_link" ("id", "title", "icon", "url") VALUES
(1,	'YouTube',	'http://localhost:8000/uploads/1649406034ytb.png',	'https://www.youtube.com/'),
(2,	'WhatUp',	'http://localhost:8000/uploads/1649406085wtsuo.png',	'https://www.whatsapp.com/?lang=ru');

DROP TABLE IF EXISTS "static_content";
DROP SEQUENCE IF EXISTS static_content_id_seq;
CREATE SEQUENCE static_content_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."static_content" (
    "id" integer DEFAULT nextval('static_content_id_seq') NOT NULL,
    "image" character varying(256) NOT NULL,
    "title" character varying(65) NOT NULL,
    "text" text,
    CONSTRAINT "static_content_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "static_content" ("id", "image", "title", "text") VALUES
(1,	'http://localhost:8000/uploads/1649401102SAVE_20200812_090713.jpg',	'Активный и нестандартный отдых!',	'<p>Что может быть хуже, чем првоести отпуск сидя за диваном и смотря телевизор? Правильно - ничего. Поэтому мы предлагаем только автинвый и нестандартный отдых!<br></p>'),
(2,	'http://localhost:8000/uploads/164940119746.jpg',	'Невероятные и экзотические места ',	'<p>Мечтаете взобраться на Эверест? Или может быть поплавать на катере над Марианской впадиной? С нами мечты становятся реальностью</p>'),
(3,	'http://localhost:8000/uploads/164940138722108d1375414e098e483c20c8ea7c74.jpg',	'Интересные и неординарные личности',	'<p>Едете в тур один? Ничего страшного - ведь наши приглашённые гости не заставят вас скучать! </p>');

DROP TABLE IF EXISTS "status";
DROP SEQUENCE IF EXISTS status_id_seq;
CREATE SEQUENCE status_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."status" (
    "id" integer DEFAULT nextval('status_id_seq') NOT NULL,
    "name" character varying(32) NOT NULL,
    CONSTRAINT "status_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "status" ("id", "name") VALUES
(1,	'В рассмотрении'),
(2,	'Отменена'),
(3,	'Ожидает оплаты'),
(4,	'Оплачена');

DROP TABLE IF EXISTS "ticket";
DROP SEQUENCE IF EXISTS ticket_id_seq;
CREATE SEQUENCE ticket_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."ticket" (
    "id" integer DEFAULT nextval('ticket_id_seq') NOT NULL,
    "event_id" integer NOT NULL,
    "price" integer NOT NULL,
    "privilege" character varying(256) NOT NULL,
    "description" text,
    CONSTRAINT "ticket_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-ticket-event_id" ON "public"."ticket" USING btree ("event_id");

INSERT INTO "ticket" ("id", "event_id", "price", "privilege", "description") VALUES
(1,	1,	89000,	'Перелёт, заселение в отель, номер люкс, 3-разовое питание',	NULL),
(2,	3,	79000,	'Неделя проживания в бунгало, перелёт, гид',	NULL),
(3,	2,	34000,	'Гид, 3-разовое питание, страховка',	NULL),
(4,	1,	129999,	'Номер президиум, 4-разовое питание, бассен, сауна, перелёт',	NULL),
(5,	4,	43999,	'Перелёт, 3-звёздочная гостиница, только питание',	NULL);

DROP TABLE IF EXISTS "ticket_application";
CREATE TABLE "public"."ticket_application" (
    "ticket_id" integer NOT NULL,
    "application_id" integer NOT NULL,
    CONSTRAINT "ticket_application_pkey" PRIMARY KEY ("ticket_id", "application_id")
) WITH (oids = false);

CREATE INDEX "idx-ticket_application-application_id" ON "public"."ticket_application" USING btree ("application_id");

CREATE INDEX "idx-ticket_application-ticket_id" ON "public"."ticket_application" USING btree ("ticket_id");

INSERT INTO "ticket_application" ("ticket_id", "application_id") VALUES
(1,	1),
(3,	2),
(3,	3),
(4,	4),
(1,	5),
(1,	6),
(2,	38);

DROP TABLE IF EXISTS "user";
DROP SEQUENCE IF EXISTS user_id_seq;
CREATE SEQUENCE user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."user" (
    "id" integer DEFAULT nextval('user_id_seq') NOT NULL,
    "login" character varying(32) NOT NULL,
    "password" character varying(256) NOT NULL,
    "email" character varying(128),
    "phone" character varying(16),
    "avatar" character varying(256),
    "role_id" integer NOT NULL,
    "access_token" character varying(256),
    "ip" character varying(15),
    CONSTRAINT "user_email_key" UNIQUE ("email"),
    CONSTRAINT "user_login_key" UNIQUE ("login"),
    CONSTRAINT "user_phone_key" UNIQUE ("phone"),
    CONSTRAINT "user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx-user-role_id" ON "public"."user" USING btree ("role_id");

INSERT INTO "user" ("id", "login", "password", "email", "phone", "avatar", "role_id", "access_token", "ip") VALUES
(3,	'core',	'$2y$13$RI9wHH1u7KIy/0cDl7SNpuS/HFgwXlLt535c6lQcbjh6j1cbbUdTq',	'kucha@mail.ru',	'+79124655343',	NULL,	3,	'tcDTlFFjKAFi9edJ_L93bSXFLNCQRkN-',	'172.18.0.1'),
(1,	'admin',	'$2y$13$n8/HFF6l56v2iwBFkLWLx.9hNOMIuTOUef6z/R.VZngxQjegYO18.',	'rsx99@mail.ru',	'+79124766374',	'http://localhost:8000/uploads/anon.jpeg',	1,	'e7KYmRhCXhKZ0P6eG_oXau87-8Ld2HWJ',	'172.18.0.1'),
(2,	'test',	'$2y$13$W/Il/Z//zvJVJQkafSD/TO3axu63dRkIE5Iq.XtUbjalm.M/j7v5u',	'sana99@mail.ru',	'+79124765634',	'http://localhost:8000/uploads/вщп.jpeg',	3,	'r8n1iQfxh2XJF6EQPxGKP8eWGEcmoBpm',	'172.18.0.1');

DROP TABLE IF EXISTS "user_event";
CREATE TABLE "public"."user_event" (
    "user_id" integer NOT NULL,
    "event_id" integer NOT NULL,
    "created_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "pk-user_event" PRIMARY KEY ("user_id", "event_id")
) WITH (oids = false);

CREATE INDEX "idx-user_event-event_id" ON "public"."user_event" USING btree ("event_id");

CREATE INDEX "idx-user_event-user_id" ON "public"."user_event" USING btree ("user_id");


ALTER TABLE ONLY "public"."application" ADD CONSTRAINT "fk-application-status_id" FOREIGN KEY (status_id) REFERENCES status(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."application" ADD CONSTRAINT "fk-application-user_id" FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."banned" ADD CONSTRAINT "fk-banned_user_id" FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."event" ADD CONSTRAINT "fk-event-place_id" FOREIGN KEY (place_id) REFERENCES place(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."event" ADD CONSTRAINT "fk-event-type_id" FOREIGN KEY (type_id) REFERENCES event_type(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."event_image" ADD CONSTRAINT "fk-event_image-event_id" FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."event_person" ADD CONSTRAINT "fk-event_person-event_id" FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."event_person" ADD CONSTRAINT "fk-event_person-person_id" FOREIGN KEY (person_id) REFERENCES person(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."event_review" ADD CONSTRAINT "fk-event_review-event_id" FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."event_review" ADD CONSTRAINT "fk-event_review-user_id" FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."person_image" ADD CONSTRAINT "fk-person_image-person_id" FOREIGN KEY (person_id) REFERENCES person(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."person_link" ADD CONSTRAINT "fk-person_link-person_id" FOREIGN KEY (person_id) REFERENCES person(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."place" ADD CONSTRAINT "fk-place-climat_code" FOREIGN KEY (climat_code) REFERENCES climat(code) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."place" ADD CONSTRAINT "fk-place-country_code" FOREIGN KEY (country_code) REFERENCES country(code) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."place_image" ADD CONSTRAINT "fk-place_image_place_id" FOREIGN KEY (place_id) REFERENCES place(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."review" ADD CONSTRAINT "fk-review-user_id" FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."ticket" ADD CONSTRAINT "fk-ticket-event_id" FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."ticket_application" ADD CONSTRAINT "fk-ticket_application-application_id" FOREIGN KEY (application_id) REFERENCES application(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."ticket_application" ADD CONSTRAINT "fk-ticket_application-ticket_id" FOREIGN KEY (ticket_id) REFERENCES ticket(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."user" ADD CONSTRAINT "fk-user-role_id" FOREIGN KEY (role_id) REFERENCES role(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."user_event" ADD CONSTRAINT "fk-user_event-event_id" FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."user_event" ADD CONSTRAINT "fk-user_event-user_id" FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE NOT DEFERRABLE;

-- 2022-04-21 16:35:00.562094+00
