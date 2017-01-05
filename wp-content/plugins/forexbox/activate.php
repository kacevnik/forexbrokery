<?php
if( !defined( 'ABSPATH')){ exit(); }		
	
$partners = get_option('fbp_parners');
if(!is_array($partners)){
$partners = array('1','0.05');
update_option('fbp_parners', $partners);
}
	 
$text = get_option('fbp_texts_material');
if(!is_array($text)){
$text = array();
$text[] = 'Сегодня как никогда стал актуален бизнес с высокой ликвидностью. И торговля на рынке Форекс – один из наиболее выигрышных вариантов, поскольку здесь можно добиться успеха, имея даже небольшой стартовый капитал. Однако данная деятельность требует серьезной подготовки, глубокого понимания движений рынка, а также умения грамотно манипулировать финансовыми активами. Соответственно, начинающему трейдеру не обойтись без помощи со стороны. Именно поэтому большинство из них предпочитают работать через опытных посредников, которыми и являются дилинговые центры и Форекс брокеры. Предлагаемый рейтинг Форекс брокеров <a href="[partner_link]" target="_blank">[url]</a> позволяет выбрать наиболее надежного «распорядителя» вашими активами. Ежедневное обновление результатов и объективные мнения опытных трейдеров помогут вам построить выгодный бизнес!';
$text[] = 'Предлагаем вашему вниманию новый рейтинг Форекс брокеров <a href="[partner_link]" target="_blank">[url]</a>. Данный ресурс призван стать верным помощником каждого трейдера в поиске своего представителя на фондовом рынке. У нас вы найдете наиболее полный список Форекс брокеров валютного и прочих финансовых рынков с указанием особенностей их деятельности, сможете сравнить их торговые условия и узнать подробную информацию о работе той или иной платформы. Удобный интерфейс, самые объективные данные, мнения опытных игроков фондового рынка о работе наиболее известных дилинговых центов и Форекс брокеров – ваш путь к финансовому успеху.';
$text[] = 'Рейтинг Форекс брокеров <a href="[partner_link]" target="_blank">[url]</a> - ваш верный помощник в выборе оптимального представителя на валютном и прочих рынках Форекс. У нас реализована эффективная система голосования реальных трейдеров, позволяющая получать объективные и, что немаловажно, актуальные на отдельно взятый момент данные относительно работы того или иного Форекс брокера или дилингового центра. Кроме того, мы предоставляем полный комплект инструментов для сравнения и анализа деятельности десятков наиболее известных брокерских фирм, что позволит вам в минимальные сроки найти опытного и эффективного распорядителя собственными активами.';
update_option('fbp_texts_material', $text);
}

$banner468 = get_option('fbp_banner_468');
if(!is_array($banner468)){
$banner468 = array();
$banner468[] = '<a href="[partner_link]"><img src="[url]/wp-content/plugins/forexbox/images/banners/468x60_1.gif" alt="Рейтинг форекс брокеров" title="Рейтинг форекс брокеров" width="468" height="60" border="0" /></a>';
update_option('fbp_banner_468', $banner468);
}

$banner200 = get_option('fbp_banner200');
if(!is_array($banner200)){
$banner200 = array();
$banner200[] = '<a href="[partner_link]"><img src="[url]/wp-content/plugins/forexbox/images/banners/200x200_1.gif" alt="Рейтинг форекс брокеров" title="Рейтинг форекс брокеров" width="200" height="200" border="0" /></a>';
update_option('fbp_banner_200', $banner200);
}

$banner120 = get_option('fbp_banner120');
if(!is_array($banner120)){
$banner120 = array();
$banner120[] = '<a href="[partner_link]"><img src="[url]/wp-content/plugins/forexbox/images/banners/120x600_1.gif" alt="Рейтинг форекс брокеров" title="Рейтинг форекс брокеров" width="120" height="600" border="0" /></a>';
update_option('fbp_banner_120', $banner120);
}

$banner100 = get_option('fbp_banner100');
if(!is_array($banner100)){
$banner100 = array();
$banner100[] = '<a href="[partner_link]"><img src="[url]/wp-content/plugins/forexbox/images/banners/100x100_1.gif" alt="Рейтинг форекс брокеров" title="Рейтинг форекс брокеров" width="100" height="100" border="0" /></a>';
update_option('fbp_banner_100', $banner100);
}

$banner88 = get_option('fbp_banner88');
if(!is_array($banner88)){
$banner88 = array();
$banner88[] = '<a href="[partner_link]"><img src="[url]/wp-content/plugins/forexbox/images/banners/88x31_1.gif" alt="Рейтинг форекс брокеров" title="Рейтинг форекс брокеров" width="88" height="31" border="0" /></a>';
update_option('fbp_banner_88', $banner88);
} 
	$pages_content = array();
	$pages_content['fbpterms'] = array(
	'post_status' => 'publish',
	'post_name' => 'fbpterms',
	'post_type' => 'page',
	'post_title' => 'Условия участия в партнерской программе',
	'post_content' => ' 
Регистрируясь на сайте в качестве партнера, вы подтверждаете свое полное согласие с настоящими правилами и обязуетесь их соблюдать.

1. Начисления и выплаты по партнерской программе ведутся в валюте USD (WebMoney WMZ).

2. Минимальная сумма для снятия заработанных денег с партнерского счета составляет $1.00.

3. За каждого привлеченного вами уникального посетителя, который воспользовался мониторингом, вы получаете $0.05;

3.1. Указанные значения партнерских вознаграждений могут быть со временем изменены. При этом все заработанные средства сохраняются на счете с учетом действовавших ранее ставок.

4. Посетитель не считается уникальным (не учитывается системой), если:
<ul>
	<li>с его IP-адреса уже совершался переход на наш сайт по партнерской ссылке в течение последних суток;</li>
	<li>его браузер не передает параметр "referer" (адрес страницы, с которой был совершен переход);</li>
	<li>он не заинтересован в использовании сервиса (не было произведено ни одного перехода внутри сайта);</li>
	<li>он перешел на наш сайт только ради получения "бесплатного бонуса".</li>
</ul>
5. Партнерам запрещается переходить по своим собственным партнерским ссылкам, либо просить других посетителей переходить по партнерским ссылкам, либо использовать любые другие виды накруток переходов.

6. На странице, где вы публикуете о нас информацию должно быть четко указано об услугах, предоставляемых нашим сервисом. В рекламных текстах запрещаются любые упоминания о наличии "бесплатных бонусов" на нашем сайте.

7. Запрещается размещать партнерскую ссылку:
<ul>
	<li>в системах активной рекламы (САР) или платного просмотра рекламных писем;</li>
	<li>на сайтах, пользующихся услугами систем активной рекламы (САР) или платного просмотра рекламных писем;</li>
	<li>в любых других системах с поощрением за просмотр сайтов;</li>
	<li>в массовых рассылках писем (СПАМ);</li>
	<li>на сайтах, принудительно открывающих окна браузера, либо открывающих сайты в скрытых фреймах;</li>
	<li>на сайтах, распространяющих любые материалы, прямо или косвенно нарушающие законодательство РФ;</li>
	<li>на сайтах, публикующих списки сайтов с "бесплатными бонусами";</li>
	<li>на веб-страницах, закрытых от публичного просмотра с помощью авторизации (различные социальные сети, закрытые разделы форумов и т.п.).</li>
</ul>
Сайты, нарушающие одно или несколько вышеперечисленных правил, будут занесены в черный список нашей партнерской программы. Оплата за посетителей, пришедших с подобных сайтов производиться не будет.

8. При несоблюдении данных условий аккаунт нарушителя будет заблокирован без выплат и объяснения причин.

9. Партнер несет полную ответственность за сохранность своих аутентификационных данных (логина и пароля) для доступа к аккаунту.

10. Данные условия могут изменяться в одностороннем порядке без оповещения участников программы, но с публикацией на этой странице.
<h1>Регистрация в партнерской программе</h1>
Пожалуйста, внимательно и аккуратно заполните все поля регистрационной формы. На указанный вами e-mail будет выслано уведомление о регистрации.
[fbp_register]	
			
	',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	
	
 	$pages_content['fbppartnersfaq'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbppartnersfaq',
	'post_author' => 1,
	'post_title' => 'Партнёрский FAQ',
	'post_content' => ' 
[fbp_user_only]

<strong>Вопрос: Как работает партнерская программа?</strong>

Ответ: Зарегистрировавшись в нашей партнерской программе, Вы получаете уникальный партнерский идентификатор, который добавляется во все Ваши ссылки (например, ?id=777) и HTML-код. Вы можете размещать ссылки на любые страницы нашего сервиса  на своем сайте, блоге, страничке, в сообществах и социальных сетях.<strong>   </strong>

<strong>Вопрос: Сколько я буду зарабатывать, участвуя в Вашей партнерской программе?</strong>

Ответ: Это зависит от многих факторов, таких как:
<ol>
	<li>Посещаемость Вашего веб-сайта или сайтов, где Вы размещаете о нас информацию.</li>
	<li>Соответствие тематики сайта той целевой аудитории, которая может заинтересоваться рейтингом форекс брокеров. Проще говоря, не стоит рассчитывать на большое количество переходов по Вашей партнерской ссылке, размещенной на сайте, посвященном разведению попугаев.</li>
	<li>Правильная подача информации. Например, мало кого привлечет одна лишь ссылка "форекс брокеры" без всяких описаний где-нибудь в углу веб-страницы.</li>
</ol>
<strong>Вопрос: Если я поставлю свою партнерскую ссылку в подпись на форуме, будут ли учитываться переходы и все остальные условия ПП?</strong>

<strong></strong>Ответ: Да, конечно будут.

<strong>Вопрос: 6 человек перешло по ссылке, а денег на счету по нулям. Почему?</strong>

Ответ: Исходя из <a href="/fbpterms">наших условий</a>, можно составить следующий список возможных причин, по которым Ваши посетители не были оплачены:
<ol>
	<li>С IP-адреса Вашего посетителя уже совершался переход на наш сайт по чей-либо партнерской ссылке (не Вашей) в течение последних 365 суток.</li>
	<li>Посетитель перешел по Вашей ссылке и сразу же ушел с сайта (не было ни одного перехода из рейтинга на сайт конкретного форекс брокера). В любом случае, в браузер посетителя, пришедшего по Вашей партнерской ссылке, устанавливается cookie с вашим партнерским идентификатором. Этот посетитель будет числиться за Вами и его повторное посещение сайта (даже без перехода по партнерской ссылке) будет оплачиваться.</li>
	<li>Браузер привлеченного Вами посетителя не передает параметр "referer". Заметьте, этот параметр также не будет передаваться, если партнерская ссылка была введена в браузер вручную (без клика по партнерской ссылке).</li>
	<li>Посетитель пришел с сайта, занесенного в черный список нашей партнерской программы (посетители с таких сайтов не оплачиваются). С причинами, по которым сайты попадают в наш список неоплачиваемых можно ознакомиться на <a href="/fbpterms">странице с условиями</a> (пункт 7).</li>
</ol>
<strong>Вопрос: На моем сайте уже установлены другие партнерские программы. Могу ли я быть Вашим партнером?</strong>

Ответ: Да, можете. У нас нет ограничений на работу с другими партнерскими программами.

<strong>Вопрос: Подходит ли мой сайт для участия в партнерской программе?</strong>

Ответ: Мы приветствуем любые сайты, которые не противоречат условиям нашей партнерской программы. Посмотреть список условий можно <a href="/fbpterms">здесь</a> (пункт 7).

<strong>Вопрос: Сколько уровней в Вашей партнерской программе? Оплачивается ли привлечение новых партнеров?</strong>

Ответ: Наша партнерская программа одноуровневая.

<strong>Вопрос: Как Вы отслеживаете накрутчиков среди партнеров?</strong>

Ответ: Большинство видов накрутки определяется нашей системой автоматически и администратору выдается список подозрительных партнеров. По каждому случаю администратор разбирается отдельно. Кроме того, при выплатах партнерам, каждый аккаунт проверяется на предмет накруток, для этого у нас есть вся необходимая статистика.

<strong>Вопрос: Не могу войти в свой аккаунт партнера. Пишет "Неверное сочетание логина и пароля". При этом я уверен, что ввожу пароль правильно.</strong>

Ответ: Убедитесь, что при вводе пароля у Вас не включена русская раскладка клавиатуры или Caps Lock. Если Вы точно помните только логин – воспользуйтесь функцией <a href="/fbplostpass/">Напоминания пароля</a>. Пароль будет выслан на Ваш e-mail, указанный при регистрации.

<strong>Вопрос: Как выплачиваются заработанные деньги?</strong>

Ответ: Партнерские выплаты производятся через систему WebMoney в валюте WMZ на кошелек, указанный партнером при регистрации в партнерской программе. После подачи заявки на выплату Ваш аккаунт будет проверяться нашим администратором на наличие попыток накрутки. Как правило, на это уходит не более 2-3 часов. Не спешите слать нам сообщения, если с момента подачи заявки не прошло 48 часов – администратор видит все заявки и обработает Вашу в любом случае.

<strong>Вопрос: Для контроля (поверьте, не ради 4 центов) совершили переход с нашего офисного компьютера по Вашей партнерской ссылке у нас на сайте. Сегодня проверил статистику – не вижу начисления партнерских. В связи с этим вопрос: как все-же происходит начисление?</strong>

Ответ: Ваш клик, вероятно, не засчитался из-за того, что проверочный переход производился с того же компьютера (либо с того же IP-адреса), с которого Вы заходили в аккаунт партнерской программы. Нашей системой не учитываются подобные переходы, чтобы исключить возможность накрутки партнерской программы.
[/fbp_user_only]	
			
	',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);
	
	$pages_content['fbppartners'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_author' => 1,
	'post_title' => 'Партнёрам',
	'post_content' => ' 
Мы предлагает вам поучаствовать в партнерской программе по привлечению посетителей. Зарегистрировавшись в нашей партнерской программе, вы будете получать $0.05 за каждого привлеченного клиента на наш сайт.

После регистрации вы получите на выбор большое количество различных промо-материалов (тексты, баннеры, скрипты и прочее), что максимально упростит вашу работу. Все, что потребуется – это приглашать посетителей на наш сайт, размещая промо-материалы на своих домашних страницах, блогах, форумах, сервисах вопросов и ответов, досках объявлений и на других ресурсах. Ваша ссылка будет содержать уникальный код, который позволит определить, что посетитель пришел по ссылке именно от вас.
<h1>Регистрация партнера</h1>
Для регистрации в партнерской программе, пройдите <a href="/terms/">по этой ссылке</a> и заполните простую форму. Перед регистрацией вам будет необходимо ознакомиться с условиями работы и принять партнерское соглашение.
<h1>Вход для партнеров</h1>
Если вы уже являетесь зарегистрированным партнером нашего рейтинга брокеров, выполните вход, используя следующую форму авторизации:

[fbp_login]
			
	',
	'post_name' => 'fbppartners',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);		

	$pages_content['fbppartners_account'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbppartners_account',
	'post_author' => 1,
	'post_title' => 'Партнёрский аккаунт',
	'post_content' => '[fbp_partners_account]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	
	
	$pages_content['fbpprofile'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_author' => 1,
	'post_name' => 'fbpprofile',
	'post_title' => 'Профиль',
	'post_content' => '[fbp_profile]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);
	
	$pages_content['fbplist'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbplist',
	'post_author' => 1,
	'post_title' => 'Листинг',
	'post_content' => '[fbp_listing count=5]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	); 
	
	$pages_content['fbppromotional'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbppromotional',
	'post_author' => 1,
	'post_title' => 'Рекламные материалы',
	'post_content' => '[fbp_promotional]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);		
		
	$pages_content['fbpwithdrawal'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_author' => 1,
	'post_name' => 'fbpwithdrawal',
	'post_title' => 'Вывод партнёрских средств',
	'post_content' => '[fbp_withdrawal]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	

	$pages_content['fbplostpass'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbplostpass',
	'post_author' => 1,
	'post_title' => 'Восстановление пароля',
	'post_content' => '[fbp_lostpass]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	
	
	$pages_content['forex_broker'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'forex_broker',
	'post_author' => 1,
	'post_title' => 'Форекс брокер',
	'post_content' => '[fbp_once]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	
	
	$pages_content['fbpsearch'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbpsearch',
	'post_author' => 1,
	'post_title' => 'Поиск брокеров',
	'post_content' => '[fbp_search]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);	
	
	$pages_content['fbpotziv'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbpotziv',
	'post_author' => 1,
	'post_title' => 'Отзывы брокера',
	'post_content' => '[fbp_otziv]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);

	$pages_content['fbpsravni'] = array(
	'post_status' => 'publish', 
	'post_type' => 'page',
	'post_name' => 'fbpsravni',
	'post_author' => 1,
	'post_title' => 'Сравнение брокеров',
	'post_content' => '[fbp_sravni]',
	'comment_status' => 'closed',
	'ping_status' => 'closed'
	);		
		
	$pages = get_option('fbp_pages');
		
	foreach(array('fbpsearch','fbpotziv','fbpsravni','fbppartners_account','fbplostpass','forex_broker','fbpprofile','fbpwithdrawal','fbppromotional','fbplist','fbpterms','fbppartners','fbppartnersfaq') as $name){
		if(!isset($pages[$name])){
			$pages[$name] = -1;
		}
    }				
		
	foreach($pages as $name => $id){
		$status = get_post_status($id);
		if($status === false){
			$pages[$name] = wp_insert_post($pages_content[$name]);
		} elseif($status != 'publish'){
			wp_update_post(array('ID' => $id, 'post_status' => 'publish'));
		}
	}
	
    update_option('fbp_pages', $pages);
	
$distable = get_option('fbp_distable');	
if(!is_array($distable)){
$distable['por'] = '1,2,3,4,5,6,7,';
$distable['enable']['fdc1']=1;
$distable['enable']['fdc2']=1;
$distable['enable']['fdc3']=1;
$distable['enable']['fdc4']=1;
$distable['enable']['fdc5']=1;
$distable['enable']['fdc6']=1;
$distable['enable']['fdc7']=1;
$distable['name']['fdoc1']='№';
$distable['name']['fdoc2']='Название';
$distable['name']['fdoc3']='Рейтинг';
$distable['name']['fdoc4']='Отзывы';
$distable['name']['fdoc5']='Статистика';
$distable['name']['fdoc6']='Статус';
$distable['name']['fdoc7']='Сравнить';
update_option('fbp_distable', $distable);
}	

$fbp_config = get_option('fbp_config');	
if(!is_array($fbp_config)){
$fbp_config['loginrating'] = 'false';
$fbp_config['logincomment'] = 'false';
update_option('fbp_config', $fbp_config);
}
	
    global $wpdb;
	
	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."forex_broker (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	`flogo` text NOT NULL,
	`fname` varchar(250)  NOT NULL,
	`fslug` varchar(250) NOT NULL,
	`fsite` varchar(250)  NOT NULL,
	`fnews` varchar(250)  NOT NULL,
	`fstatus` int(1)  NOT NULL default '0',
	`fgod` varchar(250)  NOT NULL,
	`flicense` varchar(250)  NOT NULL,
	`fplatform` varchar(250)  NOT NULL,
	`fsposobopl` text  NOT NULL,
	`fdescription` longtext  NOT NULL,
	`fadress` text  NOT NULL,
	`fplink` varchar(250)  NOT NULL,
	`fminschet` varchar(250)  NOT NULL,
	`fkrplot` varchar(250)  NOT NULL,
	`fkrpldo` varchar(250)  NOT NULL,
	`fminsdelka` varchar(250)  NOT NULL,
	`fspred` varchar(250)  NOT NULL,
	`fcomiss` varchar(250)  NOT NULL,
	`fdemo` int(1)  NOT NULL default '0',
	`fmobile` int(1)  NOT NULL default '0',
	`fpartner` int(1)  NOT NULL default '0',
	`fdovupr` int(1)  NOT NULL default '0',
	`fbonus` text NOT NULL,
	`fvkl` int(1)  NOT NULL default '0',
	`fpotz` int(5)  NOT NULL default '0',
	`footz` int(5)  NOT NULL default '0',
	`fnotz` int(5)  NOT NULL default '0',
	`frating` varchar(50) NOT NULL default '0',
	`disablertrue` int(1) NOT NULL default '1',
    `sutka` int(5) NOT NULL default '0',
    `mon` int(5) NOT NULL default '0',
    `alltime` int(5) NOT NULL default '0',
    `timer` date NOT NULL,	
    PRIMARY KEY (`id`)
    )CHARACTER SET utf8 COLLATE utf8_general_ci;");
	
	/* 
	fstatus: 0- нет 1-новый 2-рекомендуемый
	*/
	
	
	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."fbpwithdraw (
		`payid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`userid` bigint(20) NOT NULL DEFAULT '0',
		`amount` varchar(10) NOT NULL DEFAULT '0',
		`xtime` int(18) NOT NULL DEFAULT '0',
		`xdate` varchar(35) NOT NULL,
		`xstatus` int(1) NOT NULL DEFAULT '0',
		`xcomment` longtext NOT NULL,
		PRIMARY KEY (`payid`),
		KEY `userid` (`userid`),
		KEY `xstatus` (`xstatus`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");



	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."fbp_link (
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`userid` bigint(20) NOT NULL DEFAULT '0',
		`tdate` varchar(35) NOT NULL,
		`tbrowser` longtext NOT NULL,
		`ttype` int(18) NOT NULL DEFAULT '1',
		`tbroker` bigint(20) NOT NULL DEFAULT '0',
		`tip` longtext NOT NULL,
		`trefer` longtext NOT NULL,
		PRIMARY KEY (`id`),
		KEY `userid` (`userid`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
	

	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."fbp_rating (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `fb_id` bigint(20) NOT NULL,
	`rdate` date NOT NULL, 
    `rrating` int(1) NOT NULL default '1',
    `ryour` text NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."fbp_comments (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `fb_id` bigint(20) NOT NULL,
    `cemail` varchar(255) NOT NULL,
    `cactive` int NOT NULL default '0',
    `cdate` datetime NOT NULL,
    `ctext` longtext NOT NULL,
	`crating` int(1) NOT NULL,
	`hash_string` varchar(32) NOT NULL,
	`cparent` bigint(20) NOT NULL,
	`cname` varchar(250) NOT NULL,
	`cmoderate` int(1) NOT NULL default '0',
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

	$wpdb->query("CREATE TABLE IF NOT EXISTS ". $wpdb->prefix ."fbp_sravni (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `ryour` text NOT NULL,
    `rfbp` longtext NOT NULL,
    `rdate` date NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");	

	
?>