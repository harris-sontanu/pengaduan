<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0">
            <a href="/dashboard" class="d-inline-flex align-items-center">
                {{-- <img src="{{ $appLogoUrl }}" alt="{{ $appName }}"> --}}
                <h3 class="fw-bold m-0 ps-2 d-none d-sm-block font-title">
                    <span class="text-pink">Sistem Pengaduan
                </h3>
            </a>
        </div>

        <ul class="nav flex-row">
            <li class="nav-item d-lg-none">
                <a href="#navbar_search" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="collapse">
                    <i class="ph-magnifying-glass"></i>
                </a>
            </li>

            <li class="nav-item">
                <label class="btn btn-flat-white btn-icon border-transparent rounded-pill p-2" for="btncheck1">
                    <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                    <i class="ph-moon"></i>
                </label>
            </li>

        </ul>

    </div>
</div>
<!-- /main navbar -->
