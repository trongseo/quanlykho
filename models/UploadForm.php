<?php
/**
 * Created by PhpStorm.
 * User: trongnv
 * Date: 5/4/2018
 * Time: 11:17 AM
 */

namespace app\models;


use yii\base\Model;

class UploadForm extends Model
{
    /**
     * @var excelFile
     */
    public $excelFile;
    /**
     * @var excelPath
     */
    public $excelPath;
    public function rules()
    {
        return [
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx,xls,XLSX,XLS'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->excelPath ='uploads/' . $this->excelFile->baseName . date('Ydm_his').'.' . $this->excelFile->extension;
            $this->excelFile->saveAs( $this->excelPath );
            return true;
        } else {
            return false;
        }
    }
}