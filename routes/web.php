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

        //Candidate Histories
        Route::get('/candidate_histories', 'CandidateHistoriesController@index');
        Route::get('/candidate_histories/{id}', 'CandidateHistoriesController@detail');
        Route::post('/candidate_histories', 'CandidateHistoriesController@store');
        Route::put('/candidate_histories/{id}', 'CandidateHistoriesController@update');
        Route::delete('/candidate_histories/{id}', 'CandidateHistoriesController@delete');

        //Candidate Professions
        Route::get('/candidate_professions', 'CandidateProfessionsController@index');
        Route::get('/candidate_professions/{id}', 'CandidateProfessionsController@detail');
        Route::post('/candidate_professions', 'CandidateProfessionsController@store');
        Route::put('/candidate_professions/{id}', 'CandidateProfessionsController@update');
        Route::delete('/candidate_professions/{id}', 'CandidateProfessionsController@delete');

        //Candidates
        Route::get('/candidates', 'CandidatesController@index');
        Route::get('/candidates/{id}', 'CandidatesController@detail');
        Route::post('/candidates', 'CandidatesController@store');
        Route::put('/candidates/{id}', 'CandidatesController@update');
        Route::delete('/candidates/{id}', 'CandidatesController@delete');

        //Candidate Subtitutions
        Route::get('/candidate_subtitutions', 'CandidateSubtitutionsController@index');
        Route::get('/candidate_subtitutions/{id}', 'CandidateSubtitutionsController@detail');
        Route::post('/candidate_subtitutions', 'CandidateSubtitutionsController@store');
        Route::put('/candidate_subtitutions/{id}', 'CandidateSubtitutionsController@update');
        Route::delete('/candidate_subtitutions/{id}', 'CandidateSubtitutionsController@delete');

        //Candidate Trainings
        Route::get('/candidate_trainings', 'CandidateTrainingsController@index');
        Route::get('/candidate_trainings/{id}', 'CandidateTrainingsController@detail');
        Route::post('/candidate_trainings', 'CandidateTrainingsController@store');
        Route::put('/candidate_trainings/{id}', 'CandidateTrainingsController@update');
        Route::delete('/candidate_trainings/{id}', 'CandidateTrainingsController@delete');

        //Contract Periods
        Route::get('/contract_periods', 'ContractPeriodsController@index');
        Route::get('/contract_periods/{id}', 'ContractPeriodsController@detail');
        Route::post('/contract_periods', 'ContractPeriodsController@store');
        Route::put('/contract_periods/{id}', 'ContractPeriodsController@update');
        Route::delete('/contract_periods/{id}', 'ContractPeriodsController@delete');

        //Patients
        Route::get('/patients', 'PatientsController@index');
        Route::get('/patients/{id}', 'PatientsController@detail');
        Route::post('/patients', 'PatientsController@store');
        Route::put('/patients/{id}', 'PatientsController@update');
        Route::delete('/patients/{id}', 'PatientsController@delete');

        //Pjs
        Route::get('/ojs', 'PjsController@index');
        Route::get('/ojs/{id}', 'PjsController@detail');
        Route::post('/ojs', 'PjsController@store');
        Route::put('/ojs/{id}', 'PjsController@update');
        Route::delete('/ojs/{id}', 'PjsController@delete');

        //Request Logs
        Route::get('/request_logs', 'RequestLogsController@index');
        Route::get('/request_logs/{id}', 'RequestLogsController@detail');
        Route::post('/request_logs', 'RequestLogsController@store');
        Route::put('/request_logs/{id}', 'RequestLogsController@update');
        Route::delete('/request_logs/{id}', 'RequestLogsController@delete');

        //Requests
        Route::get('/requests', 'RequestsController@index');
        Route::get('/requests/{id}', 'RequestsController@detail');
        Route::post('/requests', 'RequestsController@store');
        Route::put('/requests/{id}', 'RequestsController@update');
        Route::delete('/requests/{id}', 'RequestsController@delete');

        //Request Service Sessions
        Route::get('/request_service_sessions', 'RequestServiceSessionsController@index');
        Route::get('/request_service_sessions/{id}', 'RequestServiceSessionsController@detail');
        Route::post('/request_service_sessions', 'RequestServiceSessionsController@store');
        Route::put('/request_service_sessions/{id}', 'RequestServiceSessionsController@update');
        Route::delete('/request_service_sessions/{id}', 'RequestServiceSessionsController@delete');

        //Roles
        Route::get('/roles', 'RolesController@index');
        Route::get('/roles/{id}', 'RolesController@detail');
        Route::post('/roles', 'RolesController@store');
        Route::put('/roles/{id}', 'RolesController@update');
        Route::delete('/roles/{id}', 'RolesController@delete');

        //Services
        Route::get('/services', 'ServicesController@index');
        Route::get('/services/{id}', 'ServicesController@detail');
        Route::post('/services', 'ServicesController@store');
        Route::put('/services/{id}', 'ServicesController@update');
        Route::delete('/services/{id}', 'ServicesController@delete');

        //Service Session
        Route::get('/service_sessions', 'ServiceSessionsController@index');
        Route::get('/service_sessions/{id}', 'ServiceSessionsController@detail');
        Route::post('/service_sessions', 'ServiceSessionsController@store');
        Route::put('/service_sessions/{id}', 'ServiceSessionsController@update');
        Route::delete('/service_sessions/{id}', 'ServiceSessionsController@delete');

        //Sessions
        Route::get('/sessions', 'SessionsController@index');
        Route::get('/sessions/{id}', 'SessionsController@detail');
        Route::post('/sessions', 'SessionsController@store');
        Route::put('/sessions/{id}', 'SessionsController@update');
        Route::delete('/sessions/{id}', 'SessionsController@delete');

        //Statuses
        Route::get('/statuses', 'StatusesController@index');
        Route::get('/statuses/{id}', 'StatusesController@detail');
        Route::post('/statuses', 'StatusesController@store');
        Route::put('/statuses/{id}', 'StatusesController@update');
        Route::delete('/statuses/{id}', 'StatusesController@delete');
    });
});

