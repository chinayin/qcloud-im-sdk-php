<?php

namespace QcloudIM\Crypt;

class TLSSigAPIv2
{
    private $key = false;
    private $sdkappid = 0;

    public function __construct($sdkappid, $key)
    {
        $this->sdkappid = $sdkappid;
        $this->key = $key;
    }

    /**
     * 生成签名。
     *
     * @param     $identifier
     *                             用户账号
     * @param int $expire
     *                             过期时间，单位秒，默认 180 天
     * @param     $userbuf
     *                             base64 编码后的 userbuf
     * @param     $userbuf_enabled
     *                             是否开启 userbuf
     *
     * @return string 签名字符串
     * @throws \Exception
     *
     */
    private function __genSig($identifier, int $expire, $userbuf, $userbuf_enabled): string
    {
        $curr_time = time();
        $sig_array = [
            'TLS.ver' => '2.0',
            'TLS.identifier' => strval($identifier),
            'TLS.sdkappid' => intval($this->sdkappid),
            'TLS.expire' => intval($expire),
            'TLS.time' => intval($curr_time),
        ];

        $base64_userbuf = '';
        if (true == $userbuf_enabled) {
            $base64_userbuf = base64_encode($userbuf);
            $sig_array['TLS.userbuf'] = strval($base64_userbuf);
        }

        $sig_array['TLS.sig'] = $this->hmacsha256($identifier, $curr_time, $expire, $base64_userbuf, $userbuf_enabled);
        if (false == $sig_array['TLS.sig']) {
            throw new \Exception('base64_encode error');
        }
        $json_str_sig = json_encode($sig_array);
        if (false === $json_str_sig) {
            throw new \Exception('json_encode error');
        }
        $compressed = gzcompress($json_str_sig);
        if (false === $compressed) {
            throw new \Exception('gzcompress error');
        }

        return $this->base64_url_encode($compressed);
    }

    /**
     * 验证签名。
     *
     * @param string $sig 签名内容
     * @param string $identifier 需要验证用户名，utf-8 编码
     * @param int $init_time 返回的生成时间，unix 时间戳
     * @param int $expire_time 返回的有效期，单位秒
     * @param string $userbuf 返回的用户数据
     * @param string $error_msg 失败时的错误信息
     *
     * @return bool 验证是否成功
     * @throws \Exception
     *
     */
    private function __verifySig(
        string $sig,
        string $identifier,
        int &$init_time,
        int &$expire_time,
        string &$userbuf,
        string &$error_msg
    ): bool {
        try {
            $error_msg = '';
            $compressed_sig = $this->base64_url_decode($sig);
            $pre_level = error_reporting(E_ERROR);
            $uncompressed_sig = gzuncompress($compressed_sig);
            error_reporting($pre_level);
            if (false === $uncompressed_sig) {
                throw new \Exception('gzuncompress error');
            }
            $sig_doc = json_decode($uncompressed_sig);
            if (false == $sig_doc) {
                throw new \Exception('json_decode error');
            }
            $sig_doc = (array)$sig_doc;
            if ($sig_doc['TLS.identifier'] !== $identifier) {
                throw new \Exception("identifier dosen't match");
            }
            if ($sig_doc['TLS.sdkappid'] != $this->sdkappid) {
                throw new \Exception("sdkappid dosen't match");
            }
            $sig = $sig_doc['TLS.sig'];
            if (false == $sig) {
                throw new \Exception('sig field is missing');
            }

            $init_time = $sig_doc['TLS.time'];
            $expire_time = $sig_doc['TLS.expire'];

            $curr_time = time();
            if ($curr_time > (int)($init_time + $expire_time)) {
                throw new \Exception('sig expired');
            }

            $userbuf_enabled = false;
            $base64_userbuf = '';
            if (isset($sig_doc['TLS.userbuf'])) {
                $base64_userbuf = $sig_doc['TLS.userbuf'];
                $userbuf = base64_decode($base64_userbuf);
                $userbuf_enabled = true;
            }
            $sigCalculated = $this->hmacsha256(
                $identifier,
                $init_time,
                $expire_time,
                $base64_userbuf,
                $userbuf_enabled
            );

            if ($sig != $sigCalculated) {
                throw new \Exception('verify failed');
            }

            return true;
        } catch (\Exception $ex) {
            $error_msg = $ex->getMessage();

            return false;
        }
    }

    /**
     * 生成签名.
     *
     * @param     $identifier
     *                        用户账号
     * @param int $expire
     *                        过期时间，单位秒，默认 180 天
     *
     * @return string 签名字符串
     * @throws \Exception
     *
     */
    public function genSig($identifier, int $expire = 86400 * 180): string
    {
        return $this->__genSig($identifier, $expire, '', false);
    }

    /**
     * 带 userbuf 生成签名。
     *
     * @param        $identifier
     *                           用户账号
     * @param int $expire
     *                           过期时间，单位秒，默认 180 天
     * @param string $userbuf
     *                           用户数据
     *
     * @return string 签名字符串
     * @throws \Exception
     *
     */
    public function genSigWithUserBuf($identifier, int $expire, string $userbuf): string
    {
        return $this->__genSig($identifier, $expire, $userbuf, true);
    }

    /**
     * 带 userbuf 验证签名。
     *
     * @param string $sig 签名内容
     * @param string $identifier 需要验证用户名，utf-8 编码
     * @param int $init_time 返回的生成时间，unix 时间戳
     * @param int $expire_time 返回的有效期，单位秒
     * @param string $error_msg 失败时的错误信息
     *
     * @return bool 验证是否成功
     * @throws \Exception
     *
     */
    public function verifySig(
        string $sig,
        string $identifier,
        int &$init_time,
        int &$expire_time,
        string &$error_msg
    ): bool {
        $userbuf = '';

        return $this->__verifySig($sig, $identifier, $init_time, $expire_time, $userbuf, $error_msg);
    }

    /**
     * 验证签名.
     *
     * @param string $sig 签名内容
     * @param string $identifier 需要验证用户名，utf-8 编码
     * @param int $init_time 返回的生成时间，unix 时间戳
     * @param int $expire_time 返回的有效期，单位秒
     * @param string $userbuf 返回的用户数据
     * @param string $error_msg 失败时的错误信息
     *
     * @return bool 验证是否成功
     * @throws \Exception
     *
     */
    public function verifySigWithUserBuf(
        string $sig,
        string $identifier,
        int &$init_time,
        int &$expire_time,
        string &$userbuf,
        string &$error_msg
    ): bool {
        return $this->__verifySig($sig, $identifier, $init_time, $expire_time, $userbuf, $error_msg);
    }

    /**
     * 用于 url 的 base64 encode
     * '+' => '*', '/' => '-', '=' => '_'.
     *
     * @param string $string 需要编码的数据
     *
     * @return string 编码后的base64串，失败返回false
     * @throws \Exception
     *
     */
    private function base64_url_encode(string $string): string
    {
        static $replace = ['+' => '*', '/' => '-', '=' => '_'];
        $base64 = base64_encode($string);
        if (false == $base64) {
            throw new \Exception('base64_encode error');
        }

        return str_replace(array_keys($replace), array_values($replace), $base64);
    }

    /**
     * 用于 url 的 base64 decode
     * '+' => '*', '/' => '-', '=' => '_'.
     *
     * @param string $base64 需要解码的base64串
     *
     * @return string 解码后的数据，失败返回false
     * @throws \Exception
     *
     */
    private function base64_url_decode(string $base64): string
    {
        static $replace = ['+' => '*', '/' => '-', '=' => '_'];
        $string = str_replace(array_values($replace), array_keys($replace), $base64);
        $result = base64_decode($string);
        if (false == $result) {
            throw new \Exception('base64_url_decode error');
        }

        return $result;
    }

    /**
     * 使用 hmac sha256 生成 sig 字段内容，经过 base64 编码
     *
     * @param $identifier
     *                          用户名，utf-8 编码
     * @param $curr_time
     *                          当前生成 sig 的 unix 时间戳
     * @param $expire
     *                          有效期，单位秒
     * @param $base64_userbuf
     *                          base64 编码后的 userbuf
     * @param $userbuf_enabled
     *                          是否开启 userbuf
     *
     * @return string base64后的 sig
     */
    private function hmacsha256($identifier, $curr_time, $expire, $base64_userbuf, $userbuf_enabled): string
    {
        $content_to_be_signed = 'TLS.identifier:' . $identifier . "\n"
            . 'TLS.sdkappid:' . $this->sdkappid . "\n"
            . 'TLS.time:' . $curr_time . "\n"
            . 'TLS.expire:' . $expire . "\n";
        if (true == $userbuf_enabled) {
            $content_to_be_signed .= 'TLS.userbuf:' . $base64_userbuf . "\n";
        }

        return base64_encode(hash_hmac('sha256', $content_to_be_signed, $this->key, true));
    }
}
