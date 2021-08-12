@extends('layouts.backend')

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ url('/settings') }}">Settings</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row m-0 justify-content-center">
    <div class="col-xl-8">
        <div class="content">
            <div class="block block-rounded block-fx-shadow">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Application Settings</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="block block-rounded block-bordered block-fx-shadow">
                                <a href="{{ route('settings.show', 'checklists') }}">
                                    <div class="block-header">
                                        <i class="fas fa-list text-dark mr-2"></i>
                                        <h3 class="block-title">Checklists</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="block block-rounded block-bordered block-fx-shadow">
                                <a href="{{ route('settings.show', 'emails') }}">
                                    <div class="block-header">
                                        <i class="fas fa-envelope-open-text text-dark mr-2"></i>
                                        <h3 class="block-title">Emails</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="block block-rounded block-bordered block-fx-shadow">
                                <a href="{{ route('settings.show', 'waiver') }}">
                                    <div class="block-header">
                                        <i class="fas fa-signature text-dark mr-2"></i>
                                        <h3 class="block-title">Waiver</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="block block-rounded block-bordered block-fx-shadow">
                                <a href="{{ route('settings.show', 'websites') }}">
                                    <div class="block-header">
                                        <i class="fas fa-globe text-dark mr-2"></i>
                                        <h3 class="block-title">Websites</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
