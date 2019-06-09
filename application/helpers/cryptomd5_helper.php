<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encrypt'))
{
    function encrypt( $q ) {
        $cryptKey  = 'Bl3stEmAil';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
}

if ( ! function_exists('decrypt'))
{
    function decrypt( $q ) {
        $cryptKey  = 'Bl3stEmAil';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }
}



