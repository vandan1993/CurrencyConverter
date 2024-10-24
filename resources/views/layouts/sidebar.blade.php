
<nav id="sidebar" class="d-md-block bg-light sidebar">
    <div class="position-sticky">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Menu</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a class="nav-link active" href=" {{ route('home') }}">
                        Dashboard
                    </a>
                </li>
                {{-- <li class="list-group-item">
                    <a class="nav-link" href="#">
                        Users
                    </a>
                </li> --}}
                <li class="list-group-item">
                    <a class="nav-link" href=" {{ route('userreportrequest') }}">
                        Reports
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
