@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 pb-3">
    <div class="row">
        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-calendar"></i>
                    </span>

                    <div>
                        <h5 class="m-0">0 <small>Verhuringen</small></h5>
                        <small class="text-muted">0 nieuwe aanvragen</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-users"></i>
                    </span>

                    <div>
                        <h5 class="m-0">0 <small>Gebruikers</small></h5>
                        <small class="text-muted">0 gedactiveerd</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card border-0 shadow-sm mb-4 p-2">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                        <i class="fe text-sgv-brown fe-user"></i>
                    </span>

                    <div>
                        <h5 class="m-0">0 <small>Huurders</small></h5>
                        <small class="text-muted">0 toegevoegd vandaag</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header-overview">
            <span class="text-sgv-brown" style="font-weight:650;"><i class="fe fe-calendar mr-1"></i> Nieuwe aanvragen</span>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Huurder</th>
                        <th>Periode</th>
                        <th>Aantal personen</th>
                        <th>Toegevoegd op</th>
                        <th></th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td class="text-secondary table-id">#1</td>
                            <td>Jan met de pet</td>
                            <td>10/10/1995 - 10/10/1996</td>
                            <td>45 personen</td>
                            <td>05/10/1995</td>
                            <td>
                                <span class="float-right">
                                    <a href="" class="text-secondary text-decoration-none">
                                        <i class="fe fe-eye mr-1"></i> Bekijk
                                    </a>
                                </span>
                            </td>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
