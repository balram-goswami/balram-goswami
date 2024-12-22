<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\{DashboardController, TrainingEventController};
use App\Http\Controllers\UserController\{UserEventController, PaymentHistoryController};
use App\Http\Controllers\Admin\{
    AdminController,
    EventController,
    AllStudentController,
    PaymentHisController
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/eventtraning/{id}', [TrainingEventController::class, 'index'])->name('eventtraning');
        Route::get('/userevent', [UserEventController::class, 'index'])->name('userevent');
        Route::post('/userevent/create', [UserEventController::class, 'create_event'])->name('userevent.store');

        Route::get('/courespaymentpage/{id}', [UserEventController::class, 'courespaymentpage'])->name('courespaymentpage');
        Route::get('/my_event', [UserEventController::class, 'my_event'])->name('my_event');

        Route::get('/event/edit/{id}', [UserEventController::class, 'edit'])->name('event.edit');
        Route::delete('/event/delete/{id}', [UserEventController::class, 'destroy'])->name('event.delete');
        Route::post('update/{id}', [UserEventController::class, 'update'])->name('update');

        Route::resource('PaymentHistory', PaymentHistoryController::class);
    }
);

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'dashboard']);
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    // Add other admin routes that require authentication
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/eventcreate', [EventController::class, 'create'])->name('admin.eventcreate');

        Route::get('/showcreateevent', [EventController::class, 'showcreateevent'])->name('admin.showcreateevent');
        Route::get('/upload_event_video', [EventController::class, 'upload_event_video'])->name('admin.upload_event_video');
        Route::post('/create_event', [EventController::class, 'create_event'])->name('create_event');
        Route::get('/allstudents', [AllStudentController::class, 'index'])->name('allstudents');
        Route::post('/uploadVideo', [EventController::class, 'uploadVideo'])->name('uploadVideo');

        // Controller function for Event Type Actions
        Route::get('/viewEventType', [EventController::class, 'viewEventType'])->name('admin.viewEventType');
        Route::get('/createEventType', [EventController::class, 'createEventType'])->name('admin.createEventType');
        Route::post('/saveEventType', [EventController::class, 'saveEventType'])->name('saveEventType');
        Route::delete('/destroyEventType/delete/{id}', [EventController::class, 'destroyEventType'])->name('admin.destroyEventType.delete');

        // Event Publish Request
        Route::get('publishRequestView', [EventController::class, 'publishRequestView'])->name('admin.publishRequestView');
        Route::get('publishedEventReview/{id}', [EventController::class, 'publishedEventReview'])->name('admin.publishedEventReview');
        Route::post('/publishEventStatusUpdate/{id}', [EventController::class, 'publishEventStatusUpdate'])->name('publishEventStatusUpdate');
        Route::delete('/publishEventDelete/{id}', [EventController::class, 'publishEventDelete'])->name('admin.publishEventDelete');

        Route::post('/payment-history/accept/{id}', [PaymentHisController::class, 'accept'])->name('payment-history.accept');
        Route::post('/payment-history/reject/{id}', [PaymentHisController::class, 'reject'])->name('payment-history.reject');

        Route::resource('payment_his', PaymentHisController::class);
    });
});
