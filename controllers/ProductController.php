<?php

namespace app\controllers;

use app\models\Category;

use app\models\UploadForm;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AppController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'prices', 'import'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'ghost-access'=> [
//                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
//            ],
        ];
    }
    public function actionImport(){
        $modelImport = new UploadForm();
        $pro = new Product();
        $fileName="";
        $err = "";
        if(Yii::$app->request->post()){
            $modelImport->excelFile = UploadedFile::getInstance($modelImport, 'excelFile');
            if ($modelImport->upload()) {
                $fileName = $modelImport->excelPath;
            }

            $data = Excel::import($fileName, [
                'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
                'getOnlySheet' => 'Sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
            ]);
            $transaction = Yii::$app->db->beginTransaction();
            $i=1;
            try {

                foreach ($data as $row){
                    $i ++;
                    if( isset($row['name'])){
                        $pro = new Product();
                        $pro->username= Yii::$app->user->username;
                        $pro->name= $row['name'];
                        $pro->price= $row['price'];
                        $pro->unit_id= $row['unit_id'];
                        if( $pro->validate()){
                            $pro->save();
                        }else{
                            $sumEr ="";
                            foreach ($pro->errors as $er){
                                $sumEr .= $er[0];
                            }
                            $err .= '<br/> <p>Lỗi dòng: '.$i.'(<b>'. $pro->name .')</b> '.$sumEr.'</p> <br/><br/><br/>';
                        }

                    }

                }
                if($err==""){
                    $transaction->commit();
                }else{
                    $transaction->rollBack();
                }

            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('import',[
            'model' => $modelImport,'pro'=>$pro,'err' => $err
        ]);
    }
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReport() {
        // get your HTML raw content without any layouts or scripts

       $content = $this->renderPartial('_reportView');
        $pdf_product_list_title = $this->getParaConfig("pdf_product_list_title");
        $pdf_product_list_file_name = $this->getParaConfig("pdf_product_list_file_name").date('Ymd_Hi').'.pdf';

        // setup kartik\mpdf\Pdf component
//        $pdf = new Pdf([
//            // set to use core fonts only
//            'mode' => Pdf::MODE_CORE,
//            // A4 paper format
//            'format' => Pdf::FORMAT_A4,
//            // portrait orientation
//            'orientation' => Pdf::ORIENT_PORTRAIT,
//            // stream to browser inline
//            'destination' =>Pdf::DEST_DOWNLOAD,
//            // your html content input
//            'content' => $content,
//            'filename' => $pdf_product_list_file_name,
//            // format content from your own css file if needed or use the
//            // enhanced bootstrap css built by Krajee for mPDF formatting
//            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
//            // any css to be embedded if required
//            'cssInline' => '.kv-heading-1{font-size:18px}',
//            // set mPDF properties on the fly
//            'options' => ['title' => $pdf_product_list_title],
//            // call mPDF methods on the fly
//            'methods' => [
//                'SetHeader'=>[$pdf_product_list_title],
//                'SetFooter'=>['{PAGENO}'],
//            ]
//        ]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'content' => $this->renderPartial('_reportView'),
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        $pdf =  new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader($pdf_product_list_title); // call methods or set any properties
        $mpdf->WriteHtml($this->renderPartial('_reportView')); // call mpdf write html
        echo $mpdf->Output($pdf_product_list_file_name); // call the mpdf api output as needed
        // return the pdf output as per the destination setting
        //->download('invoice.pdf');
        return $pdf->render();
    }
    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->checkPermissionModel($model);
        return $this->render('view', [
            'model' =>$model,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->username = Yii::$app->user->username;
           $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->user->username;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model =  $this->findModel($id);
        $this->checkPermissionModel($model);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrices()
    {
        $product = Product::find()->select(["id", "price", "unit", "specification"])->asArray()->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return json_encode($product);
    }


}
