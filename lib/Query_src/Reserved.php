<?php

//namespace to organize

namespace Query_src;

/**
 * fix reserved words in MySQL
 * @author Bruno Ribeiro <bruno.espertinho@gmail.com>
 * 
 * @version 0.3
 * @access public
 * @package Reserved_words
 * @author offboard
 */
class Reserved {

    /**
     * collection of words that cannot be used in the MYSQL
     * 
     * @access protected
     * @var array 
     */
    protected static $reserved_words = array('accessible', 'add', 'all', 'alter', 'analyze', 'and', 'as', 'asc', 'asensitive', 'before', 'between', 'bigint', 'binary', 'blob', 'both', 'by', 'call', 'cascade', 'case', 'change', 'char', 'character', 'check', 'collate', 'column', 'condition', 'connection', 'constraint', 'continue', 'convert', 'create', 'cross', 'current_date', 'current_time', 'current_timestamp', 'current_user', 'cursor', 'database', 'databases', 'day_hour', 'day_microsecond', 'day_minute', 'day_second', 'dec', 'decimal', 'declare', 'default', 'delayed', 'delete', 'desc', 'describe', 'deterministic', 'distinct', 'distinctrow', 'div', 'double', 'drop', 'dual', 'each', 'else', 'elseif', 'enclosed', 'escaped', 'exists', 'exit', 'explain', 'false', 'fetch', 'float', 'float4', 'float8', 'for', 'force', 'foreign', 'from', 'fulltext', 'goto', 'grant', 'group', 'having', 'high_priority', 'hour_microsecond', 'hour_minute', 'hour_second', 'if', 'ignore', 'in', 'index', 'infile', 'inner', 'inout', 'insensitive', 'insert', 'int', 'int1', 'int2', 'int3', 'int4', 'int8', 'integer', 'interval', 'into', 'is', 'iterate', 'join', 'key', 'keys', 'kill', 'label', 'leading', 'leave', 'left', 'like', 'limit', 'linear', 'lines', 'load', 'localtime', 'localtimestamp', 'lock', 'long', 'longblob', 'longtext', 'loop', 'low_priority', 'master_ssl_verify_server_cert', 'match', 'mediumblob', 'mediumint', 'mediumtext', 'middleint', 'minute_microsecond', 'minute_second', 'mod', 'modifies', 'natural', 'no_write_to_binlog', 'not', 'null', 'numeric', 'on', 'optimize', 'option', 'optionally', 'or', 'order', 'out', 'outer', 'outfile', 'precision', 'primary', 'procedure', 'purge', 'range', 'read', 'read_only', 'read_write', 'reads', 'real', 'references', 'regexp', 'release', 'rename', 'repeat', 'replace', 'require', 'reserved', 'restrict', 'return', 'revoke', 'right', 'rlike', 'schema', 'schemas', 'second_microsecond', 'select', 'sensitive', 'separator', 'set', 'show', 'smallint', 'spatial', 'specific', 'sql', 'sql_big_result', 'sql_calc_found_rows', 'sql_small_result', 'sqlexception', 'sqlstate', 'sqlwarning', 'ssl', 'starting', 'straight_join', 'table', 'terminated', 'then', 'tinyblob', 'tinyint', 'tinytext', 'to', 'trailing', 'trigger', 'true', 'undo', 'union', 'unique', 'unlock', 'unsigned', 'update', 'upgrade', 'usage', 'use', 'using', 'utc_date', 'utc_time', 'utc_timestamp', 'values', 'varbinary', 'varchar', 'varcharacter', 'varying', 'when', 'where', 'while', 'with', 'write', 'xor', 'year_month', 'zerofill', '__class__', '__compiler_halt_offset__', '__dir__', '__file__', '__function__', '__method__', '__namespace__', 'abday_1', 'abday_2', 'abday_3', 'abday_4', 'abday_5', 'abday_6', 'abday_7', 'abmon_1', 'abmon_10', 'abmon_11', 'abmon_12', 'abmon_2', 'abmon_3', 'abmon_4', 'abmon_5', 'abmon_6', 'abmon_7', 'abmon_8', 'abmon_9', 'abstract', 'alt_digits', 'am_str', 'array', 'assert_active', 'assert_bail', 'assert_callback', 'assert_quiet_eval', 'assert_warning', 'break', 'case_lower', 'case_upper', 'catch', 'cfunction', 'char_max', 'class', 'clone', 'codeset', 'connection_aborted', 'connection_normal', 'connection_timeout', 'const', 'count_normal', 'count_recursive', 'credits_all', 'credits_docs', 'credits_fullpage', 'credits_general', 'credits_group', 'credits_modules', 'credits_qa', 'credits_sapi', 'crncystr', 'crypt_blowfish', 'crypt_ext_des', 'crypt_md5', 'crypt_salt_length', 'crypt_std_des', 'currency_symbol', 'd_fmt', 'd_t_fmt', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'decimal_point', 'default_include_path', 'die', 'directory_separator', 'do', 'e_all', 'e_compile_error', 'e_compile_warning', 'e_core_error', 'e_core_warning', 'e_deprecated', 'e_error', 'e_notice', 'e_parse', 'e_strict', 'e_user_deprecated', 'e_user_error', 'e_user_notice', 'e_user_warning', 'e_warning', 'echo', 'empty', 'enddeclare', 'endfor', 'endforeach', 'endif', 'endswitch', 'endwhile', 'ent_compat', 'ent_noquotes', 'ent_quotes', 'era', 'era_d_fmt', 'era_d_t_fmt', 'era_t_fmt', 'era_year', 'eval', 'extends', 'extr_if_exists', 'extr_overwrite', 'extr_prefix_all', 'extr_prefix_if_exists', 'extr_prefix_invalid', 'extr_prefix_same', 'extr_skip', 'final', 'foreach', 'frac_digits', 'function', 'global', 'grouping', 'html_entities', 'html_specialchars', 'implements', 'include', 'include_once', 'info_all', 'info_configuration', 'info_credits', 'info_environment', 'info_general', 'info_license', 'info_modules', 'info_variables', 'ini_all', 'ini_perdir', 'ini_system', 'ini_user', 'instanceof', 'int_curr_symbol', 'int_frac_digits', 'interface', 'isset', 'lc_all', 'lc_collate', 'lc_ctype', 'lc_messages', 'lc_monetary', 'lc_numeric', 'lc_time', 'list', 'lock_ex', 'lock_nb', 'lock_sh', 'lock_un', 'log_alert', 'log_auth', 'log_authpriv', 'log_cons', 'log_crit', 'log_cron', 'log_daemon', 'log_debug', 'log_emerg', 'log_err', 'log_info', 'log_kern', 'log_local0', 'log_local1', 'log_local2', 'log_local3', 'log_local4', 'log_local5', 'log_local6', 'log_local7', 'log_lpr', 'log_mail', 'log_ndelay', 'log_news', 'log_notice', 'log_nowait', 'log_odelay', 'log_perror', 'log_pid', 'log_syslog', 'log_user', 'log_uucp', 'log_warning', 'm_1_pi', 'm_2_pi', 'm_2_sqrtpi', 'm_e', 'm_ln10', 'm_ln2', 'm_log10e', 'm_log2e', 'm_pi', 'm_pi_2', 'm_pi_4', 'm_sqrt1_2', 'm_sqrt2', 'mon_1', 'mon_10', 'mon_11', 'mon_12', 'mon_2', 'mon_3', 'mon_4', 'mon_5', 'mon_6', 'mon_7', 'mon_8', 'mon_9', 'mon_decimal_point', 'mon_grouping', 'mon_thousands_sep', 'n_cs_precedes', 'n_sep_by_space', 'n_sign_posn', 'namespace', 'negative_sign', 'new', 'noexpr', 'nostr', 'old_function', 'p_cs_precedes', 'p_sep_by_space', 'p_sign_posn', 'path_separator', 'pathinfo_basename', 'pathinfo_dirname', 'pathinfo_extension', 'pear_extension_dir', 'pear_install_dir', 'php_bindir', 'php_config_file_path', 'php_config_file_scan_dir', 'php_datadir', 'php_debug', 'php_eol', 'php_extension_dir', 'php_extra_version', 'php_int_max', 'php_int_size', 'php_libdir', 'php_localstatedir', 'php_major_version', 'php_maxpathlen', 'php_minor_version', 'php_os', 'php_output_handler_cont', 'php_output_handler_end', 'php_output_handler_start', 'php_prefix', 'php_release_version', 'php_sapi', 'php_shlib_suffix', 'php_sysconfdir', 'php_version', 'php_version_id', 'php_windows_nt_domain_controller', 'php_windows_nt_server', 'php_windows_nt_workstation', 'php_windows_version_build', 'php_windows_version_major', 'php_windows_version_minor', 'php_windows_version_platform', 'php_windows_version_producttype', 'php_windows_version_sp_major', 'php_windows_version_sp_minor', 'php_windows_version_suitemask', 'php_zts', 'pm_str', 'positive_sign', 'print', 'private', 'protected', 'public', 'radixchar', 'require_once', 'seek_cur', 'seek_end', 'seek_set', 'sort_asc', 'sort_desc', 'sort_numeric', 'sort_regular', 'sort_string', 'static', 'str_pad_both', 'str_pad_left', 'str_pad_right', 'switch', 't_fmt', 't_fmt_ampm', 'thousands_sep', 'thousep', 'throw', 'try', 'unset', 'var', 'yesexpr', 'yesstr');

    /**
     * This function handles the string to not return any error on the reserved words in MySQL
     * 
     * @param mixed $key Data
     * @return mixed
     */
    protected function replaceReservedWords($key) {
        // break here if not a data sequence
        if (!is_string($key)) {
            return $key;
        }
        // remove ` if found only 1 of this string
        if (substr_count($key, '`') == 1) {
            $key = str_replace("`", "", $key);
        }
        // checks if exist any reserved word by the MYSQL
        if (in_array($key, self::$reserved_words)) {
            // check if already exist `` in data string
            if (strpos($key, '`')) {
                return $key;
            } else {
                return (string) '`' . $key . '`';
            }
        } else {
            // ok no was found reserved word just return the data string
            return $key;
        }
    }

}
