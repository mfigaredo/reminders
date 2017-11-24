<?php 

class ReminderController extends CController {

    public function beforeAction($action)
    {
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException(400, 'Bad Request');
        return parent::beforeAction($action);
    }

    private function loadEvent($event_id)
    {
        $event = Events::model()->findByPk($event_id);
        if ($event == NULL)
            return false;
        if ($event->user_id != Yii::app()->user->id)
            return false;
        return true;
    }

    private function loadModel($id)
    {
        if ($id == NULL)
            throw new CHttpException(400, 'Bad Request');
        $model = Reminders::model()->findByPk($id);
        if ($model == NULL)
            throw new CHttpException(404, 'No model with that ID was found');
        return $model;
    }

    public function actionDelete($id = NULL)
    {
        $model = $this->loadModel($id);
        if (!$this->loadEvent($model->event_id))
            return false;
        if ($model->delete())
            return true;
        throw new CHttpException(400, 'Bad Request');
    }

    public function actionSave($id = NULL)
    {
        if ($id != NULL)
            $model = $this->loadModel($id);
        else
            $model = new Reminders;

        if (isset($_POST['Reminders']))
        {
            $model->attributes = $_POST['Reminders'];
            if (!$this->loadEvent($model->event_id))
                return false;
            if ($model->save())
                return true;
            else
                throw new CHttpException(400, print_r($model->getErrors(), true));
        }
        return true;    
    }
}

