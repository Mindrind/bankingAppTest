<!-- Bank Title Section -->
<div class="text-center py-3 bg-light border-bottom">
    <h1 class="font-weight-bold m-0">ABC BANK</h1>
</div>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- Home -->
                <a class="nav-item nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Home
                </a>
                <!-- Deposit -->
                <a class="nav-item nav-link" href="{{ route('deposit.create') }}">
                    <i class="fas fa-piggy-bank"></i> Deposit
                </a>
                <!-- Withdraw -->
                <a class="nav-item nav-link" href="{{ route('withdraw.create') }}">
                    <i class="fas fa-wallet"></i> Withdraw
                </a>
                <!-- Transfer -->
                <a class="nav-item nav-link" href="{{ route('transfer.create') }}">
                    <i class="fas fa-exchange-alt"></i> Transfer
                </a>
                <!-- Statement -->
                <a class="nav-item nav-link" href="{{ route('account.statement') }}">
                    <i class="fas fa-file-invoice-dollar"></i> Statement
                </a>
                <!-- Logout -->
                <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>