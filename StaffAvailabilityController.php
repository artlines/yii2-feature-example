<?php

namespace app\controllers;

use app\core\entities\Staff\vo\StaffActivityType;
use app\core\services\Staff\StaffAvailabilityService;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class StaffAvailabilityController extends Controller
{
    private $staffAvailabilityService;

    public function __construct(
        $id,
        $module,
        StaffAvailabilityService $staffAvailabilityService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->staffAvailabilityService = $staffAvailabilityService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create'],
                        'roles' => ['StaffAvailabilityView']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['StaffAvailabilityEditSelf', 'StaffAvailabilityDeleteAny']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'staffAvailabilityDto' => $this->staffAvailabilityService->getAvailabilityData(),
        ]);
    }

    public function actionCreate(string $type): Response
    {
        try {
            $this->staffAvailabilityService->create(
                new StaffActivityType($type),
                Yii::$app->user->identity->username
            );
        } catch (\Exception $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->addFlash('error', $exception->getMessage());
        }

        return $this->redirect(['index']);
    }

    public function actionDelete(int $id): Response
    {
        $model = $this->staffAvailabilityService->get($id);

        try {
            $this->staffAvailabilityService->remove($model);
        } catch (\Exception $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->addFlash('error', $exception->getMessage());
        }

        return $this->redirect(['index']);
    }
}
