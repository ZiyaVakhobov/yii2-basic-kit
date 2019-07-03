<?php


namespace app\components;







/**
 * Application is the base class for all web application classes.
 *
 * For more details and usage information on Application, see the [guide article on applications](guide:structure-applications).
 *
 * @property \yii\web\ErrorHandler $errorHandler The error handler application component. This property is read-only.
 * @property string $homeUrl The homepage URL.
 * @property \yii\web\Request $request The request component. This property is read-only.
 * @property \yii\web\Response $response The response component. This property is read-only.
 * @property \yii\web\Session $session The session component. This property is read-only.
 * @property \yii\web\User $user The user component. This property is read-only.
 * @property \app\components\managers\AuthManager $auth The user component. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

class Application extends \yii\web\Application
{

}