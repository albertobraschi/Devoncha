<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configuraçções de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'devoncha');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'devoncha');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'e6e9f19');

/** nome do host do MySQL */
define('DB_HOST', 'mysql.devoncha.com.br');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 			'af57e739e80e02e338ac4b9b227d781b722a654ea3b1519c89cf2201a96d87d7');
define('SECURE_AUTH_KEY', 	'29105e1ace8d9bc8c77bede5452a9d768941845c4b3ab028561077f0b0037861');
define('LOGGED_IN_KEY', 	'0ac1fb0edc16e7dfd12c49d7740bc7e9f3c64b87032ec8045d1f261a5875434d');
define('NONCE_KEY', 		'2f5ffe33a08403e204d5cf9d965d0a8b8d27fc6f8ae2927e9bf747f0b1837fdf');
define('AUTH_SALT',			'141ea848e10e546a5b21ec2d6e2858b1ffc758c4f806ec039218428683167b8e');
define('SECURE_AUTH_SALT',	'4f39221d1197b1d391095f6946dc9c0e5bbf7ea44c9c7bd91e712e42520d8c40');
define('LOGGED_IN_SALT',	'62781290ed11859ea5440fe0d54b9bca9cee567f43e1d758d04321420d6fee5d');
define('NONCE_SALT',		'ff808263f532f9fb1ff413936c962c923d1d5615ab8ea680ba0063174fc40559');
/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente a
 * língua escolhida deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define ('WPLANG', 'pt_BR');

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto do WordPress para o diretório Wordpress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
?>
