<?php
if( !defined( 'ABSPATH')){ exit(); }
add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));

function fbp_lostpass_email($reg_login,$reg_email,$key){
    
	$site_email = get_option('admin_email');
	$site_name = str_replace('http://','',get_option('siteurl'));
	$pages = get_option('fbp_pages');
	$subject = "Восстановление пароля [$site_name]"; 
	$url = get_permalink($pages['fbplostpass']);
	
        $message = ' 
        <html> 
          <head> 
        <title>'.$subject.'</title> 
          </head> 
        <body>
        <p>Кто-то запросил сброс пароля для следующей учётной записи:</p>

        <p>Имя пользователя: '.$reg_login.'</p>

        <p>Если произошла ошибка, просто проигнорируйте это письмо, и ничего не произойдёт.</p>

        <p>Чтобы сбросить пароль, перейдите по следующей ссылке:</p>

        <a href="'.$url.'/?fbpaction=rp&fbpkey='.$key.'&fbplogin='.$reg_login.'">Сбросить пароль</a>		

        <hr />
        <p>С уважением,<br />
        Aдминистрация сайта '.$site_url2.'.</p>
        </body> 
        </html>';
    
    $headers = "From: $site_name <".$site_email.">\r\n";
	return wp_mail($reg_email, $subject, $message, $headers);
}	

function fbp_registered_email($reg_login,$reg_email,$reg_pass){

    $site_email = get_option('admin_email');
	$site_name = str_replace('http://','',get_option('siteurl'));
    $subject = "Регистрация на сайте $site_name";  
        $message = ' 
        <html> 
          <head> 
        <title>'.$subject.'</title> 
          </head> 
        <body>
        <p>Здравствуйте!</p>

        <p>Вы успешно зарегистрированы в партнерской программе.
        Используйте следующие данные для доступа в партнерский кабинет:</p>

        <p>Логин: '.$reg_login.'<br />
        Пароль: '.$reg_pass.'</p>

        <p>Спасибо за регистрацию!</p>

        <hr />
        <p>С уважением<br />
        Aдминистрация '.$site_name.'<br />
        mailto:'. $site_email .'</p>
		</p>
        </body> 
        </html>';
   
    $headers = "From: $site_name <".$site_email.">\r\n"; 
    return wp_mail($reg_email, $subject, $message, $headers);
}
		
?>