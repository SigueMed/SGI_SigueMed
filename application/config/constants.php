<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
 * GLOBAL CONSTANTS SGI_SIGUEMED
 *
 */
//PERFILES
defined('ENFERMERIA')        OR define('ENFERMERIA', 1);
defined('ADMINISTRACION')        OR define('ADMINISTRACION', 2);
defined('MEDICO')        OR define('MEDICO', 3);

//ESTATUS CITA
defined('AGENDADA')        OR define('AGENDADA', 1);
defined('CONFIRMADA')        OR define('CONFIRMADA', 2);
defined('REGISTRADA')        OR define('REGISTRADA', 3);
defined('ATENDIDA')        OR define('ATENDIDA', 4);
defined('CANCELADA')        OR define('CANCELADA', 5);

//SERVICIOS INVENTARIO
defined('FARMACIA')        OR define('FARMACIA', 13);

//ESTATUS NOTA MEDICA
defined('NM_ABIERTA')        OR define('NM_ABIERTA', 1);
defined('NM_ATENDIDA')        OR define('NM_ATENDIDA', 2);
defined('NM_PAGADA')        OR define('NM_PAGADA', 3);
defined('NM_CANCELADA')        OR define('NM_CANCELADA', 4);

//TURNOS
defined('MATUTINO')        OR define('MATUTINO', 1);
defined('VESPERTINO')        OR define('VESPERTINO', 2);
defined('NOCTURNO')        OR define('NOCTURNO', 3);
defined('JORNADA')        OR define('JORNADA', 4);

//ESTATUS NOTA REMISION
defined('NR_PAGADO')        OR define('NR_PAGADO', 1);
defined('NR_CANCELADO')        OR define('NR_CANCELADO', 2);
defined('NR_PAGO_PARCIAL')        OR define('NR_PAGO_PARCIAL', 3);
defined('NR_NO_PAGADO')        OR define('NR_NO_PAGADO', 4);

//ESTATUS MOVIMIENTO CUENTA
defined('MC_PENDIENTEPAGO')        OR define('MC_PENDIENTEPAGO', 1);
defined('MC_PAGADO')        OR define('MC_PAGADO', 2);

//TIPO MOVIMIENTO CUENTA
defined('TMC_DEPOSITO')        OR define('TMC_DEPOSITO', 1);
defined('TMC_SALIDA')        OR define('TMC_SALIDAE', 2);

//TIPOS DE PAGO
defined('TIPOPAGO_EFECTIVO')        OR define('TIPOPAGO_EFECTIVO', 1);
defined('TIPOPAGO_TARJETACREDITO')        OR define('TIPOPAGO_TARJETACREDITO', 2);
defined('TIPOPAGO_TRANSFERENCIA')        OR define('TIPOPAGO_TRANSFERENCIA', 3);


defined('IMPRESORA_TICKETS')        OR define('IMPRESORA_TICKETS', 'TICKETS');

defined('ROOTPATH') OR define('ROOTPATH', __DIR__);
