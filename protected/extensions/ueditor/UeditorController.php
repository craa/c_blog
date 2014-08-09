<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-9
 * Time: 下午10:56
 */

class UeditorController extends CController
{
    public $config = array();
    private $file_paths = array();
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex($action)
    {
        //header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
        //header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
        header("Content-Type: text/html; charset=utf-8");
        $service_path = dirname(__FILE__).'/service';
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($service_path."/config.json")), true);
        $user_id = Yii::app()->user->id;
        $this->file_paths = array(
            /* 上传图片配置项 */
            "imagePathFormat"=>"/upload/image/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                                /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
                                /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
                                /* {time} 会替换成时间戳 */
                                /* {yyyy} 会替换成四位年份 */
                                /* {yy} 会替换成两位年份 */
                                /* {mm} 会替换成两位月份 */
                                /* {dd} 会替换成两位日期 */
                                /* {hh} 会替换成两位小时 */
                                /* {ii} 会替换成两位分钟 */
                                /* {ss} 会替换成两位秒 */
                                /* 非法字符 \ : * ? " < > | */
                                /* 具请体看线上文档: fex.baidu.com/ueditor/#use-format_upload_filename */

            /* 涂鸦图片上传配置项 */
            "scrawlPathFormat"=>"/upload/image/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            /* 截图工具上传 */
            "snapscreenPathFormat"=>"/upload/image/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            /* 抓取远程图片配置 */
            "catcherPathFormat"=>"/upload/image/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            /* 上传视频配置 */
            "videoPathFormat"=>"/upload/video/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            /* 上传文件配置 */
            "filePathFormat"=>"/upload/file/{$user_id}/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            /* 列出指定目录下的图片 */
            "imageManagerListPath"=>"/upload/image/{$user_id}/", /* 指定要列出图片的目录 */
            /* 列出指定目录下的文件 */
            "fileManagerListPath"=>"/upload/file/{$user_id}/", /* 指定要列出文件的目录 */
        );
        $CONFIG = array_merge($CONFIG, $this->file_paths);
        $CONFIG = array_merge($CONFIG, $this->config);

        switch ($action) {
            case 'config':
                $result =  json_encode($CONFIG);
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = include($service_path."/action_upload.php");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = include($service_path."/action_list.php");
                break;
            /* 列出文件 */
            case 'listfile':
                $result = include($service_path."/action_list.php");
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = include($service_path."/action_crawler.php");
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ),JSON_UNESCAPED_UNICODE);
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }
}