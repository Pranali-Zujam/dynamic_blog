<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard') - Dynamic Blog
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f6f8;
            font-family: Arial, sans-serif;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {

            width: 250px;
            min-height: 100vh;

            background: #212529;

            position: fixed;

            left: 0;
            top: 0;

            z-index: 1000;

            transition: .3s;
        }

        .sidebar-brand {

            height: 70px;

            display: flex;
            align-items: center;

            padding: 0 24px;

            color: #fff;

            font-size: 20px;

            font-weight: 700;

            border-bottom:
                1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-brand i {

            color: #dc3545;

            font-size: 23px;
        }

        .sidebar-menu {

            padding: 20px 12px;
        }

        .sidebar-menu a {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 12px 15px;

            margin-bottom: 6px;

            color: #adb5bd;

            text-decoration: none;

            border-radius: 8px;

            transition: .2s;
        }

        .sidebar-menu a:hover {

            background: #343a40;

            color: #fff;
        }

        .sidebar-menu a.active {

            background: #dc3545;

            color: #fff;

            box-shadow:
                0 4px 10px rgba(220, 53, 69, .25);
        }

        .sidebar-menu i {

            font-size: 18px;

            width: 22px;

            text-align: center;
        }

        /* Logout */

        .logout-button {

            display: flex;

            align-items: center;

            gap: 12px;

            width: 100%;

            padding: 12px 15px;

            background: transparent;

            border: none;

            color: #adb5bd;

            border-radius: 8px;

            text-align: left;

            transition: .2s;
        }

        .logout-button:hover {

            background: #343a40;

            color: #fff;
        }


        /* =========================
           MAIN
        ========================= */

        .main-content {

            margin-left: 250px;

            min-height: 100vh;
        }


        /* =========================
           TOP NAVBAR
        ========================= */

        .top-navbar {

            height: 70px;

            background: #fff;

            border-bottom:
                1px solid #e9ecef;

            display: flex;

            align-items: center;

            justify-content:
                space-between;

            padding: 0 30px;

            position: sticky;

            top: 0;

            z-index: 900;
        }

        .page-title {

            margin: 0;

            font-size: 21px;

            font-weight: 600;

            color: #212529;
        }

        .user-area {

            display: flex;

            align-items: center;

            gap: 10px;
        }

        .user-avatar {

            width: 40px;

            height: 40px;

            border-radius: 50%;

            object-fit: cover;
        }


        /* =========================
           CONTENT
        ========================= */

        .content-area {

            padding: 30px;
        }


        /* =========================
           CARDS
        ========================= */

        .card {

            border-radius: 12px;
        }


        /* =========================
           MOBILE
        ========================= */

        .mobile-menu {

            display: none;
        }


        @media (max-width: 768px) {

            .sidebar {

                transform:
                    translateX(-100%);
            }

            .sidebar.show {

                transform:
                    translateX(0);
            }

            .main-content {

                margin-left: 0;
            }

            .mobile-menu {

                display: inline-block;
            }

            .content-area {

                padding: 20px 15px;
            }

        }
    </style>

    @stack('styles')

</head>


<body>

    <div class="admin-wrapper">


        {{-- =========================
         SIDEBAR
    ========================= --}}

        <aside
            class="sidebar"
            id="sidebar">

            <div class="sidebar-brand">

                <i class="bi bi-journal-text me-2"></i>

                Dynamic Blog

            </div>


            <nav class="sidebar-menu">

                {{-- Dashboard --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    <i class="bi bi-speedometer2"></i>

                    Dashboard

                </a>


                {{-- Blogs --}}
                <a
                    href="{{ route('admin.blogs.index') }}"
                    class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">

                    <i class="bi bi-file-earmark-text"></i>

                    Blogs

                </a>
                {{-- Comments --}}
                <a
                    href="{{ route('admin.comments.index') }}"
                    class="{{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">

                    <i class="bi bi-chat-square-text"></i>

                    Comments

                </a>


                {{-- Categories --}}
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

                    <i class="bi bi-folder"></i>

                    Categories

                </a>


                {{-- Tags --}}
                <a
                    href="{{ route('admin.tags.index') }}"
                    class="{{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">

                    <i class="bi bi-tags"></i>

                    Tags

                </a>


                {{-- Users --}}
                <a
                    href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

                    <i class="bi bi-people"></i>

                    Users

                </a>


                <hr class="border-secondary">


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="logout-button">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </button>

                </form>



            </nav>

        </aside>


        {{-- =========================
         MAIN CONTENT
    ========================= --}}

        <main class="main-content">


            {{-- TOP NAVBAR --}}

            <header class="top-navbar">


                <div
                    class="d-flex align-items-center gap-3">


                    <button
                        class="btn btn-outline-secondary
                           mobile-menu"
                        onclick="toggleSidebar()">

                        <i class="bi bi-list"></i>

                    </button>


                    <h1 class="page-title">

                        @yield(
                        'page-title',
                        'Dashboard'
                        )

                    </h1>


                </div>


                {{-- USER --}}

                <div class="user-area">


                    @if(auth()->user()->avatar)

                    <img
                        src="{{ auth()->user()->avatar }}"
                        class="user-avatar"
                        alt="User">

                    @else

                    <div
                        class="user-avatar
                               bg-danger
                               text-white
                               d-flex
                               align-items-center
                               justify-content-center">

                        {{ strtoupper(
                            substr(
                                auth()->user()->name,
                                0,
                                1
                            )
                        ) }}

                    </div>

                    @endif


                    <span class="fw-semibold">

                        {{ auth()->user()->name }}

                    </span>

                </div>

            </header>


            {{-- PAGE CONTENT --}}

            <section class="content-area">


                @if(session('success'))

                <div id="clearMsg"
                    class="alert alert-success
                    alert-dismissible fade show">

                    {{ session('success') }}

                </div>
                @endif


                @if(session('error'))

                <div
                    class="alert alert-danger
                           alert-dismissible fade show" id="clearMsg">

                    {{ session('error') }}



                </div>

                @endif


                @yield('content')


            </section>

        </main>

    </div>


    {{-- Bootstrap JS --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <script>
        function toggleSidebar() {
            document
                .getElementById('sidebar')
                .classList
                .toggle('show');
        }
    </script>
    <script>
        let clearMsg = document.getElementById('clearMsg');

        if (clearMsg) {

            setTimeout(() => {

                clearMsg.style.display = 'none';

            }, 3000);

        }
    </script>


    @stack('scripts')

</body>

</html>