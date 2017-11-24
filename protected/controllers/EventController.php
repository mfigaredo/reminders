<?php 

class EventController extends CController{

    public function actionIndex()
    {
        $model = new Events('search');
        $model->unsetAttributes();
        if (isset($_GET['Events']))
            $model->attributes = $_GET['Events'];
        $model->user_id = Yii::app()->user->id;
        $this->render('index', array('model' => $model));
    }

    private function loadModel($id)
    {
        if ($id == NULL)
            throw new CHttpException(400, 'Bad Request');
        $model = Events::model()->findByPk($id);
        if ($model == NULL)
            throw new CHttpException(404, 'No model with that ID was found');
        return $model;
    }

    public function actionDetails($id = NULL)
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $model = $this->loadModel($id);
            $this->renderPartial('details', array('model' => $model));
            Yii::app()->end();
        }
        Throw new CHttpException(400, 'Bad Request');
    }

    public function actionSave($id = NULL)
    {
        if ($id != NULL)
            $model = $this->loadModel($id);
        else
            $model = new Events;

        if (isset($_POST['Events']))
        {
            $model->attributes = $_POST['Events'];
            if ($model->save())
                $this->redirect($this->createUrl('/event/save', array('id' => $model->id)));
        }
        $this->render('save', array('model' => $model));
    }

    public function actionDelete($id = NULL)
    {
        $model = $this->loadModel($id);
        if ($model->delete())
            $this->redirect($this->createUrl('/event'));
        throw new CHttpException(400, 'Bad Request');
    }
    
}