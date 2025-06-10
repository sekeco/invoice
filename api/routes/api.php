<?php

use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    LoginController,
    LogoutController,
    RegisterController,
    ResetPasswordController,
    UserProfileController
};
use App\Http\Controllers\Organization\{
    AddOrganizationMemberController,
    CreateOrganizationController,
    DeleteOrganizationController,
    ListOrganizationsController,
    RemoveOrganizationMemberController,
    ShowOrganizationController,
    SwitchOrganizationController,
    UpdateOrganizationController,
    UpdateOrganizationMemberRoleController
};
use App\Http\Controllers\InvoiceStatus\{
    CreateInvoiceStatusController,
    DeleteInvoiceStatusController,
    ListInvoiceStatusesController,
    UpdateInvoiceStatusController
};
use App\Http\Controllers\Invoice\{
    BulkDeleteInvoicesController,
    BulkUpdateStatusController,
    CreateInvoiceController,
    DeleteInvoiceController,
    ListInvoicesController,
    MarkInvoicePaidController,
    MarkInvoiceUnpaidController,
    RestoreInvoiceController,
    ShowInvoiceController,
    UpdateInvoiceController
};
use Illuminate\Support\Facades\Route;

// API Version 1
Route::prefix('v1')->group(function () {
    // Authentication Routes
    Route::middleware('guest')->group(function () {
        Route::post('/login', LoginController::class)->name('auth.login');
        Route::post('/register', RegisterController::class)->name('auth.register');
        Route::post('/forgot-password', ForgotPasswordController::class)->name('auth.forgot-password');
        Route::post('/reset-password', ResetPasswordController::class)->name('auth.reset-password');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        // User Profile & Auth
        Route::get('/user', UserProfileController::class)->name('user.profile');
        Route::post('/logout', LogoutController::class)->name('auth.logout');

        // Organization Management
        Route::prefix('organizations')->name('organizations.')->group(function () {
            // CRUD Operations
            Route::get('/', ListOrganizationsController::class)->name('index');
            Route::post('/', CreateOrganizationController::class)->name('store');
            Route::get('/{organization}', ShowOrganizationController::class)->name('show');
            Route::patch('/{organization}', UpdateOrganizationController::class)->name('update');
            Route::delete('/{organization}', DeleteOrganizationController::class)->name('destroy');
            Route::post('/{organization}/switch', SwitchOrganizationController::class)->name('switch');

            // Member Management
            Route::prefix('{organization}/members')->name('members.')->group(function () {
                Route::post('/', AddOrganizationMemberController::class)->name('add');
                Route::delete('/{user}', RemoveOrganizationMemberController::class)->name('remove');
                Route::patch('/{user}', UpdateOrganizationMemberRoleController::class)->name('update-role');
            });
        });

        // Invoice Status Management
        Route::prefix('invoice-statuses')->name('invoice-statuses.')->group(function () {
            Route::get('/', ListInvoiceStatusesController::class)->name('index');
            Route::post('/', CreateInvoiceStatusController::class)->name('store');
            Route::patch('/{status}', UpdateInvoiceStatusController::class)->name('update');
            Route::delete('/{status}', DeleteInvoiceStatusController::class)->name('destroy');
        });

        // Invoice Management
        Route::prefix('invoices')->name('invoices.')->group(function () {
            // CRUD Operations
            Route::get('/', ListInvoicesController::class)->name('index');
            Route::post('/', CreateInvoiceController::class)->name('store');
            Route::get('/{invoice}', ShowInvoiceController::class)->name('show');
            Route::patch('/{invoice}', UpdateInvoiceController::class)->name('update');
            Route::delete('/{invoice}', DeleteInvoiceController::class)->name('destroy');

            // Invoice Actions
            Route::post('/{invoice}/mark-paid', MarkInvoicePaidController::class)->name('mark-paid');
            Route::post('/{invoice}/mark-unpaid', MarkInvoiceUnpaidController::class)->name('mark-unpaid');
            Route::post('/{invoice}/restore', RestoreInvoiceController::class)
                ->name('restore')
                ->withTrashed();

            // Bulk Operations
            Route::prefix('bulk')->name('bulk.')->group(function () {
                Route::post('/delete', BulkDeleteInvoicesController::class)->name('delete');
                Route::post('/update-status', BulkUpdateStatusController::class)->name('update-status');
            });
        });
    });
});
