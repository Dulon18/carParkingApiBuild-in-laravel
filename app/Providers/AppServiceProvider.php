<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\BookingServiceInterface;
use App\Services\Contracts\VehicleServiceInterface;
use App\Services\Contracts\PaymentServiceInterface;
use App\Services\Contracts\ParkingSlotServiceInterface;
use App\Services\BookingService;
use App\Services\VehicleService;
use App\Services\PaymentService;
use App\Services\ParkingSlotService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
        $this->app->bind(VehicleServiceInterface::class, VehicleService::class);
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(ParkingSlotServiceInterface::class, ParkingSlotService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
