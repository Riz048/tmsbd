{-- Converted from admin/peminjaman.html to Blade --}
<!-- Put this file in resources/views/admin/peminjaman.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Perpustakaan — Peminjaman</title>

    <!-- FONT -->
    <link  rel="stylesheet">

    <!-- ICONS -->
    <link  rel="stylesheet" />

    <!-- SB ADMIN CORE -->
    <link  rel="stylesheet" />

    <!-- DATATABLES -->
    <link rel="stylesheet"  />

    <!-- STYLE GABUNG -->
    <style>
        :root {
            --primary: #001B5A99;
            --secondary: #001B5A5C;
            --bg: #FFFFFF;
        }

        body {
            font-family: "Inter";
            background: var(--bg);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, var(--secondary), var(--primary));
        }

        .sidebar .nav-link,
        .sidebar .sidebar-brand-text {
            color: #fff;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .10);
            border-radius: .35rem;
        }

        /* Card */
        .card {
            border-radius: .7rem;
            border: none !important;
        }

        .card-header {
            background: #fff !important;
            border-bottom: 1px solid rgba(0, 0, 0, .05) !important;
        }

        table.dataTable thead th {
            background: rgba(0, 0, 0, 0.04);
            font-weight: 600;
        }

        .modal-content {
            border-radius: .7rem;
            border: none;
        }

        .btn-primary {
            background: #001B5A;
            border: none;
        }

        .btn-primary:hover {
            background: #001446;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <!-- SIDEBAR -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Perpustakaan</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" ><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Data Buku</div>

            <li class="nav-item"><a class="nav-link" ><i class="fas fa-file"></i> Buku Akademik</a></li>
            <li class="nav-item"><a class="nav-link" ><i class="fas fa-book"></i> Buku Non-Akademik</a></li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Data Users</div>

            <li class="nav-item"><a class="nav-link" ><i class="fas fa-user-graduate"></i> Users</a></li>
            <li class="nav-item"><a class="nav-link" ><i class="fas fa-chalkboard-teacher"></i> Petugas</a></li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Transaksi</div>

            <li class="nav-item"><a class="nav-link" ><i class="fas fa-hand-holding"></i> Peminjaman</a></li>
            <li class="nav-item"><a class="nav-link" ><i class="fas fa-undo"></i> Pengembalian</a></li>

            <hr class="sidebar-divider">

            <li class="nav-item"><a class="nav-link" ><i class="fas fa-cog"></i> Settings</a></li>
            <li class="nav-item"><a class="nav-link" ><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>
        <!-- END SIDEBAR -->



        <!-- CONTENT WRAPPER -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- TOPBAR -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <!-- USER DROPDOWN -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle"  id="userDropdown" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" >
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
                                <a class="dropdown-item"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Settings</a>
                                <a class="dropdown-item"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- END TOPBAR -->



                <!-- PAGE CONTENT -->
                <div class="container-fluid">

                    <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-4 font-weight-bold text-gray-800">Tabel Peminjaman</h1>

    <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambahPinjam">
        <i class="fas fa-plus mr-1"></i> Tambah Peminjaman
    </button>
</div>

<div class="card fade-in mb-4">
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Pinjam</th>
                        <th>Lama</th>
                        <th>Keterangan</th>
                        <th>ID User</th>
                        <th>ID Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>PM-001</td>
                        <td>2025-01-11</td>
                        <td>7 Hari</td>
                        <td>Buku Dikembalikan</td>
                        <td>USR-01</td>
                        <td>PGW-03</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditPinjam">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>


          <div class="modal fade" id="modalTambahPinjam">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Peminjaman</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID Peminjaman</label>
                            <input type="text" class="form-control" placeholder="PM-001">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Lama (hari)</label>
                            <input type="number" class="form-control" placeholder="7">
                        </div>

                        <div class="form-group col-md-8">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID User</label>
                            <input type="text" class="form-control" placeholder="USR-01">
                        </div>

                        <div class="form-group col-md-6">
                            <label>ID Petugas</label>
                            <input type="text" class="form-control" placeholder="PGW-02">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPinjam">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Peminjaman</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID Peminjaman</label>
                            <input type="text" class="form-control" value="PM-001">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" class="form-control" value="2025-01-11">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Lama (hari)</label>
                            <input type="number" class="form-control" value="7">
                        </div>

                        <div class="form-group col-md-8">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="2">Buku Dikembalikan</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID User</label>
                            <input type="text" class="form-control" value="USR-01">
                        </div>

                        <div class="form-group col-md-6">
                            <label>ID Petugas</label>
                            <input type="text" class="form-control" value="PGW-03">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-warning text-white">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>



        <!-- LOGOUT MODAL -->
        <div class="modal fade" id="logoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ready to Leave?</h5>
                        <button class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">Click logout untuk keluar.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" >Logout</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- SCRIPT -->
    <script ></script>
    <script ></script>
    <script ></script>
    <script ></script>

    <script>
        $(document).ready(function () {
            $("#dataTable").DataTable();
        });
    </script>

</body>

</html>
