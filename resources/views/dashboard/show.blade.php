@extends('layouts.master')

@section('title', 'DashBoard')
@section('content')
    @if (isset($accountSum))
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Summary of my Financial Situation</h5>
                        <p class="card-text">Total Balance : {{$accountSum}}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endif
    @if (count($allAccount) > 0)
        <table class="table table-bordered table-hover table-responsive-md">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Account ID</th>
                <th scope="col">Account Type</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Start Balance</th>
                <th scope="col">Current Balance</th>
                <th scope="col">Relative Weight (Percentage)</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($allAccount as $account)
            <tr class="text-center">
                <td> {{$account->id}} </td>
                <td> {{$account->accountType->name}} </td>
                <td> {{$account->description}} </td>
                <td> {{$account->status}} </td>
                <td> {{$account->start_balance}} </td>
                <td> {{$account->current_balance}} </td>
                <td> {{$account->relativeWeight($accountSum)}} </td>
            </tr>
        @endforeach
            </tbody>
        </table>

        <tfoot>
            <nav aria-label="Page of Users">
                <ul class="pagination justify-content-center">
                    {{$allAccount->links()}}
                </ul>
            </nav>
        </tfoot>

        {{-- Statistics Between Given Frame --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistics Beetwen Given Frame</h5>
                        <p class="card-text">Statistical information about the total revenues and expenses by categories, on a given time frame</p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        @formFilter(['route' => 'dashboard.show', 'parameter' => \Auth::user()])
            {{-- Start Date --}}
            <div class="d-inline-flex align-items-center p-2">
                @date(['label' => 'Start Date', 'name' => 'start_date'])
                @enddate
            </div>

            {{-- End Date --}}
            <div class="d-inline-flex ml-auto align-items-center  p-2">
                @date(['label' => 'End Date', 'name' => 'end_date'])
                @enddate
                @submitButton(['name' => 'Filter']) @endsubmitButton
            </div>
        @endformFilter
        <br>

        <div class="row">
            @if (isset($statisticsRevenue))
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Revenue</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            {!! $statisticsRevenue->container() !!}
                            {!! $statisticsRevenue->script() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <br>
        <div class="row">
            @if (isset($statisticsRevenue))
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Expense</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content">
                            {!! $statisticsExpense->container() !!}
                            {!! $statisticsExpense->script() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif

@endsection
