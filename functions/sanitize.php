<?php

function escape($string) {
	return htmlentities($string);
}

function html_escape($var, $double_encode = TRUE){
    if (empty($var)){ return $var; }
    if (is_array($var)){
        return array_map('html_escape', $var, array_fill(0, count($var), $double_encode));
    }
    return htmlspecialchars($var, ENT_QUOTES, Config::get('site/charset'), $double_encode);
}

function html_encode($string, $flag=null, $charset=NULL, $double_encode = TRUE) {
    /*
        flags   Optional. Specifies how to handle quotes, invalid encoding and the used document type.
            The available quote styles are:
            ENT_COMPAT - Default. Encodes only double quotes
            ENT_QUOTES - Encodes double and single quotes
            ENT_NOQUOTES - Does not encode any quotes
            Invalid encoding:
            ENT_IGNORE - Ignores invalid encoding instead of having the function return an empty string. Should be avoided, as it may have security implications.
            ENT_SUBSTITUTE - Replaces invalid encoding for a specified character set with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD; instead of returning an empty string.
            ENT_DISALLOWED - Replaces code points that are invalid in the specified doctype with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD;
            Additional flags for specifying the used doctype:
            ENT_HTML401 - Default. Handle code as HTML 4.01
            ENT_HTML5 - Handle code as HTML 5
            ENT_XML1 - Handle code as XML 1
            ENT_XHTML - Handle code as XHTML

        character-set   Optional. A string that specifies which character-set to use.
            Allowed values are:
            UTF-8 - Default. ASCII compatible multi-byte 8-bit Unicode
            ISO-8859-1 - Western European
            ISO-8859-15 - Western European (adds the Euro sign + French and Finnish letters missing in ISO-8859-1)
            cp866 - DOS-specific Cyrillic charset
            cp1251 - Windows-specific Cyrillic charset
            cp1252 - Windows specific charset for Western European
            KOI8-R - Russian
            BIG5 - Traditional Chinese, mainly used in Taiwan
            GB2312 - Simplified Chinese, national standard character set
            BIG5-HKSCS - Big5 with Hong Kong extensions
            Shift_JIS - Japanese
            EUC-JP - Japanese
            MacRoman - Character-set that was used by Mac OS
            Note: Unrecognized character-sets will be ignored and replaced by ISO-8859-1 in versions prior to PHP 5.4. As of PHP 5.4, it will be ignored an replaced by UTF-8.

        double_encode   Optional. A boolean value that specifies whether to encode existing html entities or not.
            TRUE - Default. Will convert everything
            FALSE - Will not encode existing html entities
     */
    if (empty($string)) { return $string; }
    if (!$flag) {
        return htmlentities($string);
    } else {
        if (!$charset) {
            return htmlentities($string, $flag);
        } else {
            return htmlentities($string, $flag, $charset);
        }
    }
}

function my_html_entity_decode($string, $flag=null, $charset=NULL){
    /*
    flags   Optional. Specifies how to handle quotes and which document type to use.
    The available quote styles are:

    ENT_COMPAT - Default. Decodes only double quotes
    ENT_QUOTES - Decodes double and single quotes
    ENT_NOQUOTES - Does not decode any quotes
    Additional flags for specifying the used doctype:

    ENT_HTML401 - Default. Handle code as HTML 4.01
    ENT_HTML5 - Handle code as HTML 5
    ENT_XML1 - Handle code as XML 1
    ENT_XHTML - Handle code as XHTML

    character-set   Optional. A string that specifies which character-set to use.
    Allowed values are:

    UTF-8 - Default. ASCII compatible multi-byte 8-bit Unicode
    ISO-8859-1 - Western European
    ISO-8859-15 - Western European (adds the Euro sign + French and Finnish letters missing in ISO-8859-1)
    cp866 - DOS-specific Cyrillic charset
    cp1251 - Windows-specific Cyrillic charset
    cp1252 - Windows specific charset for Western European
    KOI8-R - Russian
    BIG5 - Traditional Chinese, mainly used in Taiwan
    GB2312 - Simplified Chinese, national standard character set
    BIG5-HKSCS - Big5 with Hong Kong extensions
    Shift_JIS - Japanese
    EUC-JP - Japanese
    MacRoman - Character-set that was used by Mac OS
    Note: Unrecognized character-sets will be ignored and replaced by ISO-8859-1 in versions prior to PHP 5.4. As of PHP 5.4, it will be ignored an replaced by UTF-8.

    USE Case
    <?php
        $str = "My name is &Oslash;yvind &Aring;sane. I&#039;m Norwegian.";
        echo html_entity_decode($str, ENT_QUOTES, "ISO-8859-1");
    ?>
    */
    if (!$flag) {
        return html_entity_decode($string);
    } else {
        if (!$charset) {
            return html_entity_decode($string, $flag);
        } else {
            return html_entity_decode($string, $flag, $charset);
        }
    }
}
