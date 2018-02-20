<?php
/**
 * Created by PhpStorm.
 * User: Amir Eslamdoust
 * Date: 2/21/18
 * Time: 2:49 AM
 */


namespace AmirEslamdoust\BankMellatPaymentService;

use Illuminate\Support\ServiceProvider;

/**
 * Class MellatPaymentServiceProvider
 * @author Amir Eslamdoust <amireslamdoust@gmail.com>
 * @package AmirEslamdoust\BankMellatPaymentService
 */
class BankMellatPaymentServiceProvider extends ServiceProvider
{

    /**
     * Configuration bindings in the container.
     *
     * @return void
     * @see https://laravel.com/api/5.2/Illuminate/Support/ServiceProvider.html
     */
    public function configuration()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('BankMellatPayment.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php', 'BankMellatPayment'
        );
    }

}