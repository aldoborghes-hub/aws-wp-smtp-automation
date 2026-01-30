<?php
/**
 * Plugin Name: Force SMTP (AWS SES)
 * Description: Fuerza el envío de correos vía SMTP usando variables de entorno.
 * Author: Aldo Borghes
 * Author URI: https://www.linkedin.com/in/aldo-borghes/
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'phpmailer_init', 'aldo_borghes_force_smtp_config' );
function aldo_borghes_force_smtp_config( $phpmailer ) {
    // Definir la ruta al archivo .env (se actualiza mediante el script de instalación)
    $env_file = '/etc/wp-smtp-placeholder.env'; 
    
    if ( ! file_exists( $env_file ) ) return;

    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $config = [];
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', str_replace('export ', '', $line), 2);
        $config[trim($name)] = trim($value, '" ');
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = $config['WP_SMTP_HOST'];
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = $config['WP_SMTP_PORT'];
    $phpmailer->Username   = $config['WP_SMTP_USER'];
    $phpmailer->Password   = $config['WP_SMTP_PASS'];
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->From       = $config['WP_SMTP_FROM'];
    $phpmailer->FromName   = get_bloginfo( 'name' );
}
