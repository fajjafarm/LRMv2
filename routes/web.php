<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\SubFacilityController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Public
// Ensure login route exists (Breeze/Fortify fix)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Public
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Facility selection & creation
    Route::get('/facilities', function () {
        return view('facility.overview');
    })->name('facility.overview');

    Route::post('/facilities', function () {
        $facility = auth()->user()->business->facilities()->create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name')),
        ]);
        auth()->user()->update(['current_facility_id' => $facility->id]);
        return redirect()->route('dashboard')->with('success', 'Facility created!');
    })->name('facility.store');

    Route::get('/facility/switch/{facility}', [FacilityController::class, 'switch'])
        ->name('facility.switch');

    // CORE LRM MODULES – ALL WORKING
    Route::view('/tasks', 'tasks.index')->name('tasks.index');
    Route::view('/pool-tests', 'pool.tests')->name('pool.tests');
    Route::view('/training', 'training.compliance')->name('training.compliance');
    Route::view('/coshh', 'coshh.index')->name('coshh.index');
    Route::view('/equipment', 'equipment.index')->name('equipment.index');
    Route::view('/palintest-import', 'palintest.import')->name('palintest.import');
    Route::view('/voice-to-log', 'voice-to-log')->name('voice.to.log');
    Route::view('/ai-assistant', 'ai-assistant')->name('ai.assistant');

    // Parent Portal (public – no auth)
    Route::get('/parent-portal/{token}', [App\Http\Controllers\ParentPortalController::class, 'show'])
        ->name('parent.portal');

    // Lifeguard Clock-In (public QR)
    Route::get('/lifeguard/{facility}', [App\Http\Controllers\LifeguardController::class, 'show'])
        ->name('lifeguard.portal');
    Route::post('/lifeguard/{facility}', [App\Http\Controllers\LifeguardController::class, 'clockin'])
        ->name('lifeguard.clockin');

    // SUPER ADMIN EMPIRE CONTROL
    Route::prefix('admin')->name('admin.')->middleware('can:access-superadmin')->group(function () {

        Route::get('/dashboard', function () {
            return view('superadmin.dashboard');
        })->name('dashboard');

        // Businesses
        Route::resource('businesses', BusinessController::class);

        // Facilities (nested under business)
        Route::get('businesses/{business}/facilities/create', [AdminFacilityController::class, 'create'])
            ->name('businesses.facilities.create');
        Route::post('businesses/{business}/facilities', [AdminFacilityController::class, 'store'])
            ->name('businesses.facilities.store');

        // Sub-Facilities
        Route::get('facilities/{facility}/sub-facilities/create', [SubFacilityController::class, 'create'])
            ->name('facilities.sub.create');
        Route::post('facilities/{facility}/sub-facilities', [SubFacilityController::class, 'store'])
            ->name('facilities.sub.store');

        // Users (add to business)
        Route::get('businesses/{business}/users/create', [AdminUserController::class, 'create'])
            ->name('businesses.users.create');
        Route::post('businesses/{business}/users', [AdminUserController::class, 'store'])
            ->name('businesses.users.store');

        // System pages
        Route::view('/pricing', 'superadmin.pricing')->name('pricing');
        Route::view('/system-health', 'superadmin.health')->name('system.health');
    });
});

// Fallback
Route::fallback(function () {
    return redirect()->route('dashboard');
});