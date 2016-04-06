<?php
    class ReviewController extends FrontendController
    {
        public $root_id;

        public function actions()
        {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    'padding' => 1,
                    'backColor' => 0xFFFFFF,
                    'maxLength' => 7,
                    'minLength' => 5,
                    'foreColor' => 0x727272,
                    'width' => '98px',
                    'height' => '38px',
                ),
            );
        }

        public function init()
        {
            parent::init();
            $this->root_id = 1;
        }

        public function actionIndex()
        {
            $pagesize = 3;

            $reviews = new ReviewItem();
            $dataProvider = $reviews->getReviewProvider($pagesize, '', '', ReviewItem::STATUS_PLACEMENT);

            $this->render('index', array('model' => $dataProvider, 'count' => $pagesize));
        }

        public  function actionAdd()
        {
            $setting = ReviewSetting::model()->findAll(array('select'=>'id, status'));
            $review = new ReviewItem('insert');
            if(isset($_POST['ReviewItem'])){
                $review->attributes = $_POST['ReviewItem'];
                if($review->validate()){
                    if($setting[1]->status == 1){
                        $review->status = ReviewItem::STATUS_PLACEMENT;
                        Yii::app()->user->setFlash('modal', Yii::t('app', 'Your review successfully published'));
                    }
                    else{
                        Yii::app()->user->setFlash('modal', Yii::t('app','Your review has been successfully sent to moderation'));
                        $review->status = ReviewItem::STATUS_NEW;
                    }
                    if ($setting[2]->status == 1 and !Yii::app()->user->isGuest){
                        $user = Users::model()->findByPk(Yii::app()->user->id);
                        $review->user_id = $user->id;
                        $review->email = $user->email;
                        $review->phone =$user->user_info->phone;
                        $review->fullname = $user->user_info->getFullName();
                    }
                    $review->save();
                }
            }
            $this->render('new_review',array('review'=>$review, 'setting'=>$setting));
        }

        public function actionList()
        {

        }
}