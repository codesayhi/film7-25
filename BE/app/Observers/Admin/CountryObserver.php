<?php

namespace App\Observers\Admin;

use App\Models\Country;

class CountryObserver
{
    /**
     * Handle the Country "created" event.
     */
    public function created(Country $country): void
    {
        //
        $country->created_by = 1;
    }

    /**
     * Handle the Country "updated" event.
     */
    public function updated(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "deleted" event.
     */
    public function deleted(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "restored" event.
     */
    public function restored(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "force deleted" event.
     */
    public function forceDeleted(Country $country): void
    {
        //
    }
}
