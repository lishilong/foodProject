<?php

namespace common\helper;
use Yii;


class ImagePathHelper
{

    /**
     *   获取图片
     * @param $photo
     * @param string $size
     * @return string
     */
    public static function getImage($photo, $size = '100x100')
    {
        if (strlen($photo) == 0)
            return '';
        $size = strtolower($size);
        $paths = explode('/', $photo);
        $photoName = array_pop($paths);
        $resizePhoto = implode('/', $paths) . '/' . $size . '_' . $photoName;
        return $resizePhoto;
    }

    /** 转换资源url
     * @param $url
     * @return string
     */
    public static function resUrl($url)
    {
        if (empty($url))
            return '';

        if (stripos($url, '/upload') === 0) {

            $url = app()->request->getHostInfo() . $url;
            return $url;
        } else {
            $url =app()->request->getHostInfo().'/res' . $url;
            return $url;
        }
    }


    function replace_outer_links($message)
    {
        $local_domain_arr = ['http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"]];

        $pattern = '/<[^>]*href=[\'\"]http[s]?:\/\/(?!';
        $i = 0;
        foreach ($local_domain_arr as $local_domain) {
            if ($i == 0) {
                $pattern .= 'www.' . $local_domain . '|' . $local_domain . '|[\w\_]+\.' . $local_domain;
            } else {
                $pattern .= '|www.' . $local_domain . '|' . $local_domain . '|[\w\_]+\.' . $local_domain;
            }
            $i++;
        }
        $pattern .= ')[^\'^\"]*[\'\"][^>]*>(.+?)<\/a>/is';
        return preg_replace($pattern, '$1', $message);
    }

    /**
     * 剔换图片本地地址
     * @param $input
     * @return mixed
     */
    public static function replace_pic($input)
    {
        return str_replace(Yii::$app->getRequest()->getHostInfo(), '', $input);
    }


    /**
     *  获取分隔url数组
     * @param $urlStr
     * @return array
     */
    public static function    getPicUrlArray($urlStr)
    {

        if (isset($urlStr)) {
            $urlStr = trim($urlStr);
            if (!empty($urlStr)) {
                $urlArr = explode(",", $urlStr);
                return $urlArr;
            }
        }
        return array();
    }

    /**
     *  根据图片取相应图片校列
     * @param $urlStr
     * @return string
     */
    public static function    getPicUrl($urlStr)
    {
        $result = self::getPicUrlArray($urlStr);
        if (empty($result)) {
            return publicResources() . '/images/picture.png';
        }
        $r = $result[0];
        $reg = '/\.(gif|jpe?g|png)$/i';
        if (preg_match($reg, $r)) {
            return publicResources() . $r;
        }
        return publicResources() . '/images/picture.png';
    }

    /**
     * 取正文的图片
     * @param $context
     * @return mixed
     */
    public static function   getRegPic($context)
    {
        preg_match_all("/<img.*?src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", $context, $matches);
        return $matches[1];
    }

    /**
     * 班级文件类型显示对应的图片
     */
    public static function getFilePic($url)
    {

        $result = self::getPicUrlArray($url);
        if (empty($result)) {
            return publicResources_new() . "/images/test_paper_img.png";
        }
        $r = $result[0];
        $regPic = '/\.(gif|jpe?g|png)$/i';
        $regPpt = '/\.(ppt|pptx)$/i';
        $regDoc = '/\.(doc|docx)$/i';
        if (preg_match($regPic, $r)) {
            return publicResources_new() . "/images/test_paper_img3.png";
        }
        if (preg_match($regPpt, $r)) {
            return publicResources_new() . "/images/test_paper_img4.png";
        }
        if (preg_match($regDoc, $r)) {
            return publicResources_new() . "/images/test_paper_img2.png";
        }
        return publicResources_new() . "/images/test_paper_img.png";


    }

    public static function  resImage($url)
    {
        if (empty($url)) {
            return [];
        }
        $url = self::resUrl($url);

        $regPic = '/\.(gif|jpe?g|png)$/i';
        if (preg_match($regPic, $url)) {

            return [$url];
        }
//        $paths = explode('/', $url);
//        $photoName = array_pop($paths);
//        $masterName = pathinfo($photoName)['filename'];
//
//        $fileUrl = implode('/', $paths) . '/' . $masterName . '/';
//        $jsonFile = $fileUrl . 'pagelist.json';
//
        $picArr = [];
//        $curlHelper = new   XcurlHelper();
//        if ($curlHelper->getRemoteFileExist($jsonFile)) {
//            $picArr = [];
//
//            $json = $curlHelper->get_content($jsonFile);
//            $arr = json_decode($json);
//            foreach ($arr as $i) {
//                $picArr[] = $fileUrl . $i;
//            }
//        }

        return $picArr;

    }


}