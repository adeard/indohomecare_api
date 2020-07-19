<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api',  'middleware' => 'cors'], function () {

    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::get('/activation/{email}', 'UserController@activation');

    Route::group(['middleware' => 'auth'], function () {
        //User
        Route::get('/users', 'UserController@index');
        Route::get('/users/{id}', 'UserController@detail');
        Route::put('/users/{id}', 'UserController@update');
        Route::delete('/users/{id}', 'UserController@delete');

        //Roles
        Route::get('/roles', 'RoleController@index');
        Route::get('/roles/{id}', 'RoleController@detail');
        Route::post('/roles', 'RoleController@store');
        Route::put('/roles/{id}', 'RoleController@update');
        Route::delete('/roles/{id}', 'RoleController@delete');

        //Patients
        Route::get('/patients', 'PatientsController@index');
        Route::get('/patients/{id}', 'PatientsController@detail');
        Route::get('/patients/pjs/{pj_id}', 'PatientsController@getGroupPJ');
        Route::post('/patients', 'PatientsController@store');
        Route::put('/patients/{id}', 'PatientsController@update');
        Route::delete('/patients/{id}', 'PatientsController@delete');

        //Contracts
        Route::get('/contracts', 'ContractController@index');
        Route::get('/contracts/statistic', 'ContractController@statistic');
        Route::get('/contracts/{id}', 'ContractController@detail');
        Route::post('/contracts', 'ContractController@store');
        Route::put('/contracts/{id}', 'ContractController@update');
        Route::delete('/contracts/{id}', 'ContractController@delete');

        //Contract Histories
        Route::get('/contract_histories', 'ContractHistoryController@index');
        Route::get('/contract_histories/{id}', 'ContractHistoryController@detail');
        Route::post('/contract_histories', 'ContractHistoryController@store');
        Route::put('/contract_histories/{id}', 'ContractHistoryController@update');
        Route::delete('/contract_histories/{id}', 'ContractHistoryController@delete');

        //Event Contracts
        Route::get('/event_contracts', 'EventContractController@index');
        Route::get('/event_contracts/{id}', 'EventContractController@detail');
        Route::post('/event_contracts', 'EventContractController@store');
        Route::put('/event_contracts/{id}', 'EventContractController@update');
        Route::delete('/event_contracts/{id}', 'EventContractController@delete');

        //Medic Tool Contracts
        Route::get('/medic_tool_contracts', 'MedicToolContractController@index');
        Route::get('/medic_tool_contracts/{id}', 'MedicToolContractController@detail');
        Route::post('/medic_tool_contracts', 'MedicToolContractController@store');
        Route::put('/medic_tool_contracts/{id}', 'MedicToolContractController@update');
        Route::delete('/medic_tool_contracts/{id}', 'MedicToolContractController@delete');

        //Medic Tools
        Route::get('/medic_tools', 'MedicToolController@index');
        Route::get('/medic_tools/{id}', 'MedicToolController@detail');
        Route::post('/medic_tools', 'MedicToolController@store');
        Route::put('/medic_tools/{id}', 'MedicToolController@update');
        Route::delete('/medic_tools/{id}', 'MedicToolController@delete');

        //Medic Tool Sessions
        Route::get('/medic_tool_sessions', 'MedicToolSessionController@index');
        Route::get('/medic_tool_sessions/{id}', 'MedicToolSessionController@detail');
        Route::get('/medic_tool_sessions/medic_tool/{medic_tool_id}', 'MedicToolSessionController@getMedicTools');
        Route::post('/medic_tool_sessions', 'MedicToolSessionController@store');
        Route::put('/medic_tool_sessions/{id}', 'MedicToolSessionController@update');
        Route::delete('/medic_tool_sessions/{id}', 'MedicToolSessionController@delete');

        //Nurse Categories
        Route::get('/nurse_categories', 'NurseCategoryController@index');
        Route::get('/nurse_categories/{id}', 'NurseCategoryController@detail');
        Route::post('/nurse_categories', 'NurseCategoryController@store');
        Route::put('/nurse_categories/{id}', 'NurseCategoryController@update');
        Route::delete('/nurse_categories/{id}', 'NurseCategoryController@delete');

        //Nurse Contracts
        Route::get('/nurse_contracts', 'NurseContractController@index');
        Route::get('/nurse_contracts/{id}', 'NurseContractController@detail');
        Route::post('/nurse_contracts', 'NurseContractController@store');
        Route::put('/nurse_contracts/{id}', 'NurseContractController@update');
        Route::delete('/nurse_contracts/{id}', 'NurseContractController@delete');

        //Nurses
        Route::get('/nurses', 'NurseController@index');
        Route::get('/nurses/{id}', 'NurseController@detail');
        Route::post('/nurses', 'NurseController@store');
        Route::put('/nurses/{id}', 'NurseController@update');
        Route::delete('/nurses/{id}', 'NurseController@delete');

        //Nurse Sessions
        Route::get('/nurse_sessions', 'NurseSessionController@index');
        Route::get('/nurse_sessions/{id}', 'NurseSessionController@detail');
        Route::get('/nurse_sessions/nurse_category_id/{nurse_category_id}', 'NurseSessionController@getNurseCategory');
        Route::post('/nurse_sessions', 'NurseSessionController@store');
        Route::put('/nurse_sessions/{id}', 'NurseSessionController@update');
        Route::delete('/nurse_sessions/{id}', 'NurseSessionController@delete');

        //PJs
        Route::get('/pjs', 'PjController@index');
        Route::get('/pjs/{id}', 'PjController@detail');
        Route::post('/pjs', 'PjController@store');
        Route::put('/pjs/{id}', 'PjController@update');
        Route::delete('/pjs/{id}', 'PjController@delete');

        //Therapist
        Route::get('/therapist', 'TherapistController@index');
        Route::get('/therapist/{id}', 'TherapistController@detail');
        Route::post('/therapist', 'TherapistController@store');
        Route::put('/therapist/{id}', 'TherapistController@update');
        Route::delete('/therapist/{id}', 'TherapistController@delete');

        //Therapist Type
        Route::get('/therapist_types', 'TherapistTypeController@index');
        Route::get('/therapist_types/{id}', 'TherapistTypeController@detail');
        Route::post('/therapist_types', 'TherapistTypeController@store');
        Route::put('/therapist_types/{id}', 'TherapistTypeController@update');
        Route::delete('/therapist_types/{id}', 'TherapistTypeController@delete');

        //Therapist Contract
        Route::get('/therapist_contracts', 'TherapistContractController@index');
        Route::get('/therapist_contracts/{id}', 'TherapistContractController@detail');
        Route::post('/therapist_contracts', 'TherapistContractController@store');
        Route::put('/therapist_contracts/{id}', 'TherapistContractController@update');
        Route::delete('/therapist_contracts/{id}', 'TherapistContractController@delete');

        //Therapist Session
        Route::get('/therapist_session', 'TherapistSessionController@index');
        Route::get('/therapist_session/{id}', 'TherapistSessionController@detail');
        Route::get('/therapist_session/therapist_type_id/{therapist_type_id}', 'TherapistSessionController@getTherapistType');
        Route::post('/therapist_session', 'TherapistSessionController@store');
        Route::put('/therapist_session/{id}', 'TherapistSessionController@update');
        Route::delete('/therapist_session/{id}', 'TherapistSessionController@delete');

        //Transport Contracts
        Route::get('/transport_contracts', 'TransportContractController@index');
        Route::get('/transport_contracts/{id}', 'TransportContractController@detail');
        Route::post('/transport_contracts', 'TransportContractController@store');
        Route::put('/transport_contracts/{id}', 'TransportContractController@update');
        Route::delete('/transport_contracts/{id}', 'TransportContractController@delete');

        //Transport Times
        Route::get('/transport_times', 'TransportTimeController@index');
        Route::get('/transport_times/{id}', 'TransportTimeController@detail');
        Route::post('/transport_times', 'TransportTimeController@store');
        Route::put('/transport_times/{id}', 'TransportTimeController@update');
        Route::delete('/transport_times/{id}', 'TransportTimeController@delete');

        //Transport Times
        Route::get('/contract_statuses', 'ContractStatusController@index');
        Route::get('/contract_statuses/{id}', 'ContractStatusController@detail');
        Route::post('/contract_statuses', 'ContractStatusController@store');
        Route::put('/contract_statuses/{id}', 'ContractStatusController@update');
        Route::delete('/contract_statuses/{id}', 'ContractStatusController@delete');
    });
});

