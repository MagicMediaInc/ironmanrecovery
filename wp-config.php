<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'ironmanrecovery');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'ironmanrecovery');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'iron4102');

/** nome do host do MySQL */
define('DB_HOST', '186.202.152.194');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{aW$keEkNfTx&qV7v$:I43KJ6Re]-+2Rb^~%-ec|6Z!Fc5,U?t@p]zF~,az^lD}z');
define('SECURE_AUTH_KEY',  '0V#y-YD|0WpN8Ib:,x*H$3}^S5ru>Na|&bA;.QSfrt0/W}!pV#qB3%^<|l+U!nhi');
define('LOGGED_IN_KEY',    'W$ZTIP]sU:}Kn$e0W1{j`Hjut0?6PYg58:jf:B9@RK6-Bq?StWznlhk8n&9n*a2a');
define('NONCE_KEY',        '4-I,N7|4QeIss!d--lWLapL_5-8`6Lg/iK-|bZFoM%d7G0fS}>8qh12YZ?w|tMgF');
define('AUTH_SALT',        'FD4=^@Eb*8!K{XG&~H%WJ5`:C:3b0b0zm?TPXQAuwE3*gmZ{T1/|i`CSbQ0#;u?F');
define('SECURE_AUTH_SALT', '+~u3_:d}PjNosC4os9e5w+#_:F.OcBt;AbZd{*-CJIE0~eJ}LOPhI$Fs>w?+s&Ki');
define('LOGGED_IN_SALT',   '2tRTZQ=C<ViA c&^+k=_F,Dm!~@C<+amFixu%T~|LBWGyP-Ffo/mrgkJ{H.lJ8S=');
define('NONCE_SALT',       'kSZ4l[a;0$paN/iJZ~o`9!FW]|(~O|GCfYKc}x!7<nsgg~m>zLBw}CL3.<|1}-s3');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
