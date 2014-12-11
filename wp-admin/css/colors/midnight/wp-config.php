<?php
/** 
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro é usado para criar o script  wp-config.php, durante
 * a instalação, mas não tem que usar essa funcionalidade se não quiser. 
 * Salve este ficheiro como "wp-config.php" e preencha os valores.
 *
 * @package WordPress
 */
define('WP_MEMORY_LIMIT', '64M');
// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define('DB_NAME', 'ironmanrecovery');


/** O nome do utilizador de MySQL */
define('DB_USER', 'ironmanrecovery');


/** A password do utilizador de MySQL  */
define('DB_PASSWORD', 'iron4102');


/** O nome do serviddor de  MySQL  */
define('DB_HOST', 'mysql01.ironmanrecovery.hospedagemdesites.ws');


/** O "Database Charset" a usar na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O "Database Collate type". Se tem dúvidas não mude. */
define('DB_COLLATE', '');

/**#@+
 * Chaves Únicas de Autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$+6XWcW]<BL_t&tQxR3^7+n^p&cBaPGcrPj(PCow0[0kq;G}iP#b=Q^+:zcyr2Tm');

define('SECURE_AUTH_KEY',  'R?XG/cwaV3n^fm*-^5O[c{j9U+7i_qd^**<4sq[6q(-8g`^[~-EisprSB|8GY<bF');

define('LOGGED_IN_KEY',    'TPDa_Uf]b-~{RssRg]RLvS~,58y<O*JelW7>LsA0)xlZ|?aU{9}o7l9~+kJ5WrM,');

define('NONCE_KEY',        '8];(KkdztL$s(8pAmqb:1{1ARwIf,Zf=F{oZxwe9aeV6tbZ^,u+_b4RT{BLQ[_z8');

define('AUTH_SALT',        '+z2?jq[qAVi5OLWlKqEFK#d##s%Cpqc>jtV5|bIO,agc[))dYkr>|@gaCxXt.ux?');

define('SECURE_AUTH_SALT', '/Ih9@RVu:q62J;EOo/M;{a/+ooW{;7k%<=WXCLBO(lQf/8U={^H,@:_^%LPh/4*b');

define('LOGGED_IN_SALT',   'wASO?dJ?;T]5bf:_|O:KR=S[^Po#>bLWW#U1QSUi}B9fTpr:=%KPENun8}`}^ %X');

define('NONCE_SALT',       '[-Em5-(Cw-nUKzv-e+b.^PSSbXU0NY/7o@{5{_Z|K7d-7pU DX?YC0!SILg-|O5E');


/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix  = 'wp_';


/**
 * Idioma de Localização do WordPress, Inglês por omissão.
 *
 * Mude isto para localizar o WordPress. Um ficheiro MO correspondendo ao idioma
 * escolhido deverá existir na directoria wp-content/languages. Instale por exemplo
 * pt_PT.mo em wp-content/languages e defina WPLANG como 'pt_PT' para activar o
 * suporte para a língua portuguesa.
 */
define('WPLANG', 'pt_PT');

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 */
define('WP_DEBUG', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . 'wp-settings.php');
